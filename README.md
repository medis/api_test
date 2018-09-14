[![CircleCI](https://circleci.com/gh/medis/api_test.svg?style=svg)](https://circleci.com/gh/medis/api_test)
# Installation<br/>
run in root folder:<br/>
`php -S localhost:8000 -t public`<br/><br/>
# How to use solution<br/>
Fetch a recipe by id:<br/>
`http://localhost:8000/api/v1/recipes/1`<br/>
Fetch a recipe by id for frontend:<br/>
`http://localhost:8000/api/v1/recipes/1/frontend`<br/>
Fetch a recipe by id for mobile:<br/>
`http://localhost:8000/api/v1/recipes/1/mobile`<br/><br/>
Fetch all reciped for a specific cuisine<br/>
`http://localhost:8000/api/v1/cuisine/asian`<br/>
Fetch all reciped for a specific cuisine for frontend<br/>
`http://localhost:8000/api/v1/cuisine/asian/frontend`<br/>
Fetch all reciped for a specific cuisine for mobile<br/>
`http://localhost:8000/api/v1/cuisine/asian/mobile`<br/><br/>
Rate an existing recipe between 1 and 5<br/>
`curl -X POST -F 'recipe_id=1' -F 'rating=3' 'http://localhost:8000/api/v1/rating'`<br/><br/>
Update existing recipe<br/>
`curl -X POST -F 'title="New title"' -F 'id=1' 'http://localhost:8000/api/v1/recipes/1'`<br/><br/>
Store a new recipe<br/>
`curl -X POST -F 'title="New title"' -F 'short_title="New"' 'http://localhost:8000/api/v1/recipes'`<br/><br/>
Run tests in root folder<br/>
`phpunit`<br/>
# Why Lumen web application framework?<br/>
I chose Lumen because I am a big fan of Laravel and this solution needed to be just an API, hence why I chose Lumen. I do believe Laravel is getting bigger every day, getting more and more support from the community and the coding experience is just superb. Also you guys mentioned you are using Laravel/Lumen.<br/>
# How my solution would cater for a different API consumers that require different recipe data<br/>
There are many ways how to achieve this. I think I chose one of the easier solutions where Recipe data is filtered by a specific Resource for a specific consumer. See App\Http\Resources. Then there is a base Recipe controller which cater for a default dataset but child controllers inject specific resource to it. See App\Http\Controllers\RecipeDefaultController, RecipeFrontendController and RecipeMobileController. This way all consumers are decoupled, can be easily tested and if needed, methods can be overriden. Also, in current implementation all uncought consumers will default to default resource.<br/>
# Anything else I think is relevant to my solution<br/>
The csv file is being loaded using middleware. During each request, all migrations will be run and seeded. This way I did not need to use any type of database but the data is not persistent between requests. See App\Http\Middleware\MemoryDbSeeder, migration and seeding is made to be production ready. Just need to plug in the database and remove the middleware. I made the recipes fetch by cuisine endpoint to be seo optimised by passing title instead of id. This is made in RecipeCuisine model in getQualifiedKeyName function. To revert back to id, remove said function.