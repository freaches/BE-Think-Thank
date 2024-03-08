package models

import (
	"go.mongodb.org/mongo-driver/bson/primitive"
)

type Avatar struct {
	Id       primitive.ObjectID `json:"id" bson:"_id"`
	Image    string             `json:"image" bson:"image"`
	Diamond  string             `json:"diamond" bson:"diamond"`
	IsLocked string             `json:"isLocked" bson:"isLocked"`
}
