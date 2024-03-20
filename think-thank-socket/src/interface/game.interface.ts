export interface IUser {
    userId : string
    username : string
    socketId : string
}
export interface IGame {
    user : IUser
    choice : string
    roomName : string
}

export interface IRoom {
    name : string
    host : IUser
    users : IUser[]
}

export interface ServerToClientEvents {
    game : (e : IGame) => void
}

export interface ClientToServerEvents {
    game : (e : IGame) => void;
    join_room : (e : {user :IUser; roomName : string;}) => void;
}