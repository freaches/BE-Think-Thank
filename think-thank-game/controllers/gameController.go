package controllers

import (
	"context"
	"fmt"
	"think-thank-game/initializers"
	"think-thank-game/models"

	"github.com/gin-gonic/gin"
	"go.mongodb.org/mongo-driver/bson"
	"go.mongodb.org/mongo-driver/mongo"
)

func GetAll(c *gin.Context) {
	var avatars []models.Game
	coll := initializers.DB.Database("think-thank").Collection("question")
	// var result bson.M
	cursor, err := coll.Find(context.TODO(), bson.D{})

	if err == mongo.ErrNoDocuments {
		fmt.Printf("No document was found")
		return
	}

	if err != nil {
		panic(err)
	}
	if err = cursor.All(context.TODO(), &avatars); err != nil {
		panic(err)
	}

	c.JSON(200, gin.H{
		"data": avatars,
	})
	// err := coll.FindOne(context.TODO(), bson.D{}).Decode(&result)
	// if err == mongo.ErrNoDocuments {
	// 	fmt.Printf("No document was found with the title %s\n", title)
	// 	return
	// }
	// if err != nil {
	// 	panic(err)
	// }
	// jsonData, err := json.MarshalIndent(result, "", "    ")
	// if err != nil {
	// 	panic(err)
	// }
	// fmt.Printf("%s\n", &jsonData)

	// c.JSON(200, gin.H{
	// 	"avatar": result,
	// })
}
