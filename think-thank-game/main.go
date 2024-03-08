package main

import (
	"think-thank-game/initializers"
	"think-thank-game/routes"
)

func init() {
	initializers.LoadEnvVariable()
	initializers.ConnecToDB()
}

func main() {
	// coll := initializers.DB.Database("think-thank").Collection("avatars")
	// title := "Back to the Future"
	// var result bson.M
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
	// fmt.Printf("%s\n", &coll)
	routes.Routes()
}
