# MongoSQL:

## Introduction:

This project is a personal investigation related to the use, fundamentals and implementation of the Repository Pattern in a simple application made in Laravel. 

## Technologies used:

* _**PHP**_
* _**Laravel**_
* _**Javascript**_
* _**JQuery**_
* _**Bootstrap**_
* _**Docker**_
* _**MongoDB Atlas**_
* _**MySQL**_

## Fundamentals:

In my years of working on Laravel projects of all kinds, I've come to realize that this is a hotly debated topic.
All developers have very different opinions about the use, the implementation and if it is really necessary to use; the Repository Pattern.
I hope in this project I can demonstrate my point of view on this issue and make a contribution, however small, to our beloved community.

To begin this journey, we must ask ourselves... What is the Repository pattern?
In the way that I've traveled to answer this question, I've found myself analyzing all kinds of applications,
in different languages, trying to put a definition that encompasses all the characteristics of each one of them.
In the end, after analyzing it for a long time, I came up with, in my humble opinion, one that fits with all of them: **Set of interfaces**

Obviously this would be something basic, because if we go to something more specific it would be something like this:
**Set of interfaces that allows abstracting the logic related to the data model, in order to use it in different kind of databases.**

All of us who've worked for a long time in software development, know that this case is very atypical,
since in 99% of them it's decided in advance, in the requirements phase, which type of database one is going to work.
If we start to think, Eloquent, the Laravel ORM, is already a repository of the same, since it allows us to interact or act as a bridge
between the database and the application. Thanks to it, we are abstracted from having to communicate with the relational database,
throwing queries manually.
That is why if the problem belongs to this previously mentioned one percent, or there is a special situation which
we are forced to have to interact with relational and non-relational databases at the same time; read until the end, because you are in the right place.

I'm a fan of going straight to look for practical examples, so, following this premise, let's suppose: 

We are required to work with MongoDB and MySQL and we must develop an implementation that allows us to develop an application,
which can make all sort of database operations, both in MongoDB and MySQL. Is this possible?, and the answer to this question is,
without hesitation, **YES**. And this application is proof of that.

Before continuing, you can see the application running on this [_link_](https://www.google.com),
and you can see the corresponding database diagram [here](https://github.com/guille1988/mongosql/blob/main/docs/database_diagram.png)

To put things in context, the situation is like this:

* A post has one task
* A task has many posts
* A task has many items
* An item has many tasks through a pivot table called 'item_task'

Continuing with the explanation, in the application, you will find the posts and tasks table, with all
previously mentioned relationships. This table contains the basic actions corresponding to a
CRUD and a button to change relational database (MySQL) to non-relational (MongoDB).

The focus of the application is located, in which one can perform all the basic operations of a CRUD, added
to all relational operations between tables/documents, treated the same as each other, thanks to the Repository Pattern.

The key question would be, how is this pattern designed and implemented in the application? I will explain it below:

I've built an interface that, depending on the selected database, will automatically be constructed with the proper model.
For that, I've made a BaseRepository that can auto-resolve his child repositories, but for more control, you can do that on your own.
Let me demonstrate you with portions of the code:


This code is in AppServiceProvider.php:

```php

    private array $repositories = ['post', 'user', 'task', 'item'];

    public function buildPath(string $name, bool $isInterface = true, ?string $dbType = NULL): string
    {
        $repositoryPath = 'App\Repositories\\';

        return $isInterface ?
            $repositoryPath . "Interfaces\\$name" . 'RepositoryInterface' :
            $repositoryPath . "$dbType\\$name" . 'Repository';
    }

    public function bind(string $repository): void
    {
        $name = ucfirst($repository);
        $database = config('database.default') == 'mongodb' ? 'Mongo' : 'Sql';

        $this->app->bind($this->buildPath($name), $this->buildPath($name, false, $database));
    }

    public function register(): void
    {
        collect($this->repositories)->map(fn($repository) => $this->bind($repository));
    }

```

It binds to the interface the corresponding model according to the selected database.


This is BaseRepository.php:

```php

    private SqlModel|MongoModel $model;

    protected function model(): string
    {
        $model = str_replace('Repository','',class_basename($this));
        $folder = config('database.default') == 'mongodb' ? "Mongo" : "Sql";

        return "App\Models\\$folder\\$model";
    }

    public function __construct(){$this->model = app($this->model());}

    public function all(): Collection
    {
        return $this->model->all();
    }

    public function create(array $data): mixed
    {
        return $this->model->create($data);
    }

    public function find(int|string $id): mixed
    {
        return $this->model->find($id);
    }

    public function update(array $data, int|string $id): bool
    {
        return $this->model->find($id)->update($data);
    }

    public function delete(int|string $id): bool
    {
        return $this->model->destroy($id);
    }

```

It auto-resolve all child repositories, but as I said before, if you want more control, you can overwrite
model() method to return exactly the model that belongs to the specific child:

```php

    namespace App\Repositories\Mongo;
    
    use App\Repositories\Interfaces\PostRepositoryInterface;
    use App\Repositories\BaseRepository;
    
    class PostRepository extends BaseRepository implements PostRepositoryInterface
    {
        protected function model(): string
        {
            return Post::class; 
        }
    }

```

Then it is easy, controllers are constructed by an instance of the corresponding repository and the magic happens:

This is PostController.php:

```php
class PostController extends Controller
{
    public function __construct(private readonly PostRepositoryInterface $postRepository){}

    public function index(): View
    {
        try
        {
            $posts = $this->postRepository->all()->load('task');
            $tasks = app(TaskRepositoryInterface::class)->all();

            $databaseInfo = app(DatabaseService::class)->getAllDataInfo(config('database.default'));
            $data = array_merge(compact(['posts', 'tasks']), $databaseInfo);

            return view('tables.posts.table', $data);
        }
        catch(Exception|Error $error)
        {
            return view('tables.posts.table')->with(compact('error'));
        }
    }
```
We can communicate directly with the interface that resolve for us, the corresponding model and method for each operation.

If you want to develop some method that contains different implementations on each model, you can put it in their specific repository.

```php
    <?php
    
    namespace App\Repositories\Mongo;
    
    use App\Repositories\Interfaces\PostRepositoryInterface;
    use App\Repositories\BaseRepository;
    
    class PostRepository extends BaseRepository implements PostRepositoryInterface 
    {
        public function create(array $data): mixed
        {
            //Implement what you want here
        }
    }
```
I want to clarify that, in my opinion, Repositories has nothing to do with Services. Services are methods that are meant
to help Controllers with a lot of functionality within. You can use Repositories inside them, but they work in
different ways.

## Conclusion:

I really hope this tiny work helps someone in his IT journey. This is a result, as I said before, of a lot of investigation
in many languages and projects over the years. If you like what you've read, please star me, I'd really appreciate it.

## Issues:

For any issues, questions or suggestions, please don't hesitate to post it in issues or send a mail to the one above.

## Security:

If you discover any security-related issues, please email [guill388@hotmail.com](mailto:guill388@hotmail.com) instead of using the issue tracker.

## Credits:

Special thanks to [Francisco Panozzo](https://github.com/franpanozzo) who greatly helped me along the way =).

