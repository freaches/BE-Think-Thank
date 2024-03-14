package models

import (
	"go.mongodb.org/mongo-driver/bson/primitive"
)

type Game struct {
	Id          primitive.ObjectID `json:"id" bson:"_id"`
	Question    string             `json:"question" bson:"question"`
	AnswerTrue  string             `json:"answerTrue" bson:"answerTrue"`
	AnswerFalse []string           `json:"answerFalse" bson:"answerFalse"`
	Score       string             `json:"score" bson:"score"`
	Hint        string             `json:"hint" bson:"hint"`
}
