package models

type Avatar struct {
	Image    string `json:"image" bson:"image"`
	Diamond  string `json:"diamond" bson:"diamond"`
	IsLocked string `json:"isLocked" bson:"isLocked"`
}
