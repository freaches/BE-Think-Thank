import { Injectable } from '@nestjs/common';
import { IRoom, IUser } from 'src/interface/game.interface';

@Injectable()
export class RoomService {
    public rooms : IRoom[] = [];

    async addRoom(roomName : string, host : IUser) : Promise<void> {
        const room = await this.getRoomIndexByName(roomName);
        if (room === -1) {
            await this.rooms.unshift({ name: roomName, host, users: [host] });
          }
    }
    async removeRoom(roomName : string) : Promise<void> {
        const findRoom = await this.getRoomIndexByName(roomName);
        if (findRoom !== -1) {
            this.rooms = this.rooms.filter(room => room.name !== roomName);
        }
    }

    async getRoomHost(roomName : string) : Promise<IUser> {
        const roomIndex = await this.getRoomIndexByName(roomName);
        return this.rooms[roomIndex].host
    }

    async getRoomIndexByName(roomName : string) : Promise<number> {
        const roomIndex = this.rooms.findIndex((room) => room?.name === roomName);
        return roomIndex
    }

    async getRoomByName(roomName : string) : Promise<IRoom> {
        const roomIndex = await this.getRoomIndexByName(roomName);
        return this.rooms[roomIndex]
    }

    async addUserToRoom(roomName :string, user: IUser): Promise<void>{
        const roomIndex = await this.getRoomIndexByName(roomName);
        const room = await this.getRoomByName(roomName)
        if (roomIndex !== -1) {
            const host  = room.host
            if (host.userId === user.userId){
                this.rooms[roomIndex].host.socketId = user.socketId
            }else{
                this.rooms[roomIndex].users.push(user);
            }
        }
        else {
        await this.addRoom(roomName, user)
    }}

    async getRooms(): Promise<IRoom[]> {
        return this.rooms
      }
}
