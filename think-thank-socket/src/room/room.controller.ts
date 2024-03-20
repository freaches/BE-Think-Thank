import { Controller, Get, Param, Post } from '@nestjs/common';
import { IRoom } from 'src/interface/game.interface';
import { RoomService } from './room.service';

@Controller()
export class RoomController {
  constructor(private roomService: RoomService) {}

  @Get('api/rooms')
  async getAllRooms(): Promise<IRoom[]> {
    return await this.roomService.getRooms();
  }

  @Get('api/rooms/:room')
  async getRoom(@Param() params): Promise<IRoom> {
    const rooms = await this.roomService.getRooms();
    const room = await this.roomService.getRoomIndexByName(params.room);
    return rooms[room];
  }
}
