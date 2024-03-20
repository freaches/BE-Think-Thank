import { Logger, OnModuleInit } from '@nestjs/common';
import {
  MessageBody,
  OnGatewayConnection,
  OnGatewayDisconnect,
  SubscribeMessage,
  WebSocketGateway,
  WebSocketServer,
} from '@nestjs/websockets';
import { Server, Socket } from 'socket.io';
import {
  ClientToServerEvents,
  IGame,
  IUser,
  ServerToClientEvents,
} from 'src/interface/game.interface';
import { RoomService } from 'src/room/room.service';

@WebSocketGateway({
  cors: {
    origin: '*',
  },
})
export class GameGateway implements OnGatewayConnection, OnGatewayDisconnect{
  constructor(private roomService: RoomService) {}

  @WebSocketServer() server: Server = new Server<
    ServerToClientEvents,
    ClientToServerEvents
  >();

  private logger = new Logger('GameGateway');

  @SubscribeMessage('game')
  async handleEvent(@MessageBody() payload): Promise<IGame> {
    this.logger.log(payload);
    this.server.to(payload.roomName).emit('game', payload);
    console.log(payload)
    return payload; 
  }

  @SubscribeMessage('timer')
  async handleTimerEvent(@MessageBody() payload): Promise<void> {
    let dur = 15
    const interval = setInterval(()=>{
      console.log(`counting ${dur}`)
      this.server.to(payload.roomName).emit('timer',dur);

      if(dur > 0){
        dur--
      } 
      if(dur == 0){
        console.log('game start')
        clearInterval(interval)
      }
    },1000)
    
    
  }

  @SubscribeMessage('join_room')
  async handleSetClientDataEvent(
    @MessageBody()
    user: IUser
  ) {
    console.log(user)
    if (user.socketId) {
      const roomLength = this.roomService.rooms.length;
      if (roomLength < 1) {
        const roomName = user.socketId;

        this.logger.log(`${user.socketId} is joining ${roomName}`);

        await this.server.in(user.socketId).socketsJoin(roomName);
        await this.roomService.addUserToRoom(roomName, user);

        const room = await this.roomService.getRoomByName(roomName);

        this.server.to(roomName).emit('join_room', room);
      }
      if (roomLength > 0) {
        const room = this.roomService.rooms[0];
        console.log(room)
        if (room.users.length == 5) {
          const roomName = user.socketId;

          this.logger.log(`${user.socketId} is joining ${roomName}`);

          await this.server.in(user.socketId).socketsJoin(roomName);
          await this.roomService.addUserToRoom(roomName, user);

          const room = await this.roomService.getRoomByName(roomName);

          this.server.to(roomName).emit('join_room', room);
        }

        if(room.users.length < 5) {
          this.logger.log(`${user.socketId} is joining ${room.name}`);

          await this.server.in(user.socketId).socketsJoin(room.name);
          await this.roomService.addUserToRoom(room.name, user);

          this.server.to(room.name).emit('join_room', room);
        }
      }
      console.log(this.roomService.rooms)
    }
  }

  async handleConnection(socket: Socket) {
    this.logger.log(`user connected to ${socket.id}`);
    console.log(`user connected to ${socket.id}`);
  }

  async handleDisconnect(socket: Socket) {
    this.logger.log(`user connected to ${socket.id}`);
    console.log(`user connected to ${socket.id}`);
  }
}
