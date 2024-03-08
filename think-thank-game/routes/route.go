package routes

import (
	"think-thank-game/controllers"

	"github.com/gin-gonic/gin"
)

func Routes() {
	r := gin.Default()

	r.GET("/avatar", controllers.GetAll)

	r.Run()
}
