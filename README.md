# MongoSQL project:

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
**Set of interfaces that allows abstracting the logic related to the data model, in order to use it in different databases.**

All of us who've worked for a long time in software development, know that this case is very atypical,
since in 99% of them it' i's decided in advance, in the requirements phase, which type of database one is going to work.
If we start to think, Eloquent, the Laravel ORM, is already a repository of the same, since it allows us to interact or act as a bridge
between the database and the application. Thanks to it, we are abstracted from having to communicate with the relational database,
throwing queries manually.
That is why if the problem belongs to this previously mentioned one percent, or there is a special situation which
we are forced to have to interact with relational and non-relational databases at the same time; read until the end, because you are in the right place.

I'm a fan of going straight to look for practical examples, so, following this premise, let's suppose: 



## Installation:

```php
composer require felipetti/service-layer
```

