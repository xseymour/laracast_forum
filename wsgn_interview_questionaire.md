SQL
=============

Given the following tables:

```
users

|----|---------|--------|
| id | name    | active |
|----|---------|--------|
| 1  | Alice   |  Y     |
| 2  | Bob     |  N     |
| 3  | Charlie |  Y     |
| 4  | Dave    |  Y     |
| 5  | Eve     |  N     |
|----|---------|--------|


users_meta

|----|---------|----------|
| id | user_id | location |
|----|---------|----------|
| 1  |  3      | "NY"     |
| 2  |  1      | "NJ"     |
| 3  |  3      | "PA"     |
| 4  |  2      | "CA"     |
| 5  |  2      | "HK"     |
| 6  |  4      | "NY"     |
| 7  |  5      | "NJ"     |
|----|---------|----------|

```
1. Write a sql statement that selects all users with a location in NJ. *

    SELECT users.*
    FROM users
    LEFT JOIN users_meta on users.id = users_meta.user_id
    WHERE location = 'NJ'

2. Write a sql statement that deletes all rows in users_meta for inactive users. **

    DELETE FROM users
    WHERE active = 'N'

3. If the select statement in #1 is the only type of statement that gets run on this database, list all the keys/indexes you would have on these tables. ***

    - Foreign key within users_meta tying users_meta.user_id to users.id (OnUpdate = Cascade, OnDelete = Cascade)
    - Primary key on users.id
    - Primary key on users_meta.id
    - Index on users_meta.location

4. What's the difference between and INNER, OUTER, LEFT, and RIGHT JOIN? *

    Given that joins attempt to link related tables in relational databases:
    -INNER Join requires a match to be made (value in left/base table must also exist in right/joining table) for the joined row to make it to the result set.
    -LEFT Joins will include all rows from the left table, regardless of a match existing between the two joining tables
    -RIGHT Joins essentially work the same way as LEFT joins, except the requirements are reversed: All rows from the joining table will make it to the result set, regardless of a match existing between the two joining tables
    -OUTER Joins will return all rows from both the base and joining tables regardless of any matches. Can be thought of as performing a left join union a right join




CS Fundamentals
=============
1. In the Map / Reduce / Filter model in functional programming: **
    a. What does Map do? **

        -Map describes a means by which we can 'map' all values in a collection to another set of values. (Returns new collection)

    b. What does Reduce do? **

        -Reduce is used when you want to find a cumulative value based on the elements within a collection. (Returns cumulative value)
        

    c. What does Filter do? **

        -Filter can be used to remove elements from a collection based on some condition, thus filtering the intial collection. (Returns new collection)

2. What are the differences between a prototypal inheritance scheme (i.e. Javascript) and a static inheritance scheme (i.e. PHP/Java/C++)? ***

    Class Inheritance in PHP/Java/C++ is an inheritance scheme where the base class acts like a blueprint for any subclasses. This provides a means by which code can be shared by objects. However, Class inheritance can easily lead to the tight coupling problem, resulting in an inflexible hierarchy that is not quite right for evolving objects. That is, you may have only wanted to inherit a portion of the code in the base class, but instead you inherited everything.
    Prototypal Inheritance is an inheritance scheme where where objects inherit directly from other objects. That is, you have the ability to use composition to select the portions of code you want to inherit from the base objects, thus giving you more freedom.
    
    Given the following binary tree:

    ```
          A
         / \
        B   C
       / \   \
      D   E   F
     /
    G
    ```
3. In what order would you visit the nodes in a depth-first traversal? *
    
    Preorder: A, B, D, G, E, C, F
    Inorder: G, D, B, E, A, C, F
    Postorder: G, D, E, B, F, C, A

    
4. In what order would you visit the nodes in a breadth-first traversal? *
    
    A, B, C, D, E, F, G

Web Technologies
=============
1. Consider XHR and Web Sockets: *
    a. Give an example of an application where you would want to use Web Sockets and not an XHR.

        Would want to use Web Sockets when continuous streams of data are required from the server as opposed to XHR which provides data on request from the browser, usually prompted by means of an html event like 'onclick', 'keyup', etc. 

        A good example might be establishment of a web socket to present a live temperature feed.

    b. Give an example of an application where you would want to use an XHR and not Web Sockets.

        Would want to use XHR when browser (user) requests asynchrously loaded data from the server. 
        
        I.E. Assume your web application provides a Country drop-down. Assume also that upon choosing a Country from this dropdown, we want to populate a 'State' dropdown with options from the chosen Country. XHR would be a good fit for fetching the data to load into the State dropdown.

2. What is the difference between an HTTP PUT and HTTP POST? **
    
    Post should be used to create new records.
    Put should be used to update existing records, but may also be used to create new records.

3. What type of data is best served from a CDN? *
    
    Static data is best served from a CDN. As websites are mostly comprised of static data being fetched by a broswer, CDN's can be used to decrease latency between a user and a website. Anything from HTML, Javascript files, Stylesheets, Fonts, Images, Audio/Video files can be served from a CDN.
  
4. What port is http served on? ssh? *

    HTTP is usually served via port 80
    SSH  is on port 22
	
5. What does a HTTP response code in the 4XX range mean? *
    
    Client based error
	
6. How should the text character `&` be represented in html? *

    &amp;
	
7. In javascript, how do you get the root node of the DOM? *
    
    document.documentElement
    

8. Given the following html:

	```
	<html>
		<title>
		</title>
		<body>
			<div id="greeting" class="body_text"> Hello, world! </div>
			<div class="body_text">
				<span> Here's some cool text! </span>
			</div>
			<span class="footer"> Sign up for our <a href="/email/"> email list </a> </span>
		</body>
	</html>
	```
	a. Write a CSS selector that selects the first `<div>` and not the second one. *

        '#greeting'
	
	b. Write a CSS selector that selects the second `<span>` and not the first one. *

        'span.footer'
	
	c.  Write a CSS selector that selects the first `<span>` and not the second one. *	

        'body span:first-child'


Coding Question
=============
Given data that looks like this:

```
$retailers = [
    [
        'name' => 'abercrombie and fitch',
        'popularity' => 20,
        'country' => 'US'
    ],
    [
        'name' => 'about you',
        'popularity' => 60,
        'country' => 'DE'
    ],
    [
        'name' => 'amazon',
        'popularity' => 200,
        'country' => 'US'
    ],
    [
        'name' => 'asos',
        'popularity' => 100,
        'country' => 'US'
    ],
    [
        'name' => 'asos',
        'popularity' => 80,
        'country' => 'UK'
    ],
];
```

And the following class:

```
<?php
class Retailers {

    // Is invoked on each element in the $retailers array
    public function addRetailer($retailer) {

    }

    /* 1. Find the most popular retailer for every country *
     *
     */   Returns the (string) name of the most popular retailer in a country
    public function mostPopularRetailer($country) {
        $retailers_in_country = array_filter($retailers, function($retailer) use ($country){
            return $retailer['country'] == $country;
        });

        $most_popular = $this->mostPopularInSet($retailers_in_country);
        return isset($most_popular['name']) ? $most_popular['name'] : null;
        
    }

    //Helper function 
    public function mostPopularInSet($retailer_subset)
    {
        $most_popular = null;
        foreach ($retailer_subset as $retailer) {
            if (is_null($most_popular) || $retailer['popularity'] > $most_popular['popularity']) {
                $most_popular = $retailer;
            }
        }
        return $most_popular;
    }

    /* 2. Write an autocomplete function *
     *
     *    Returns the (string) name of the most popular retailer 
     *    whose name starts with the autocomplete string.
     */   If the string matches exactly a retailer's name, return that name.
    public function autocomplete($autocomplete_prefix) {

        $retailers_with_prefix = array_filter($this->retailers, function($retailer) use ($autocomplete_prefix) {
            return strpos($retailer['name'], $autocomplete_prefix) === 0;
        });

        $most_popular = $this->mostPopularInSet($retailers_with_prefix);
        return isset($most_popular['name']) ? $most_popular['name'] : null;
        
    }
    
    /* 3. Bonus: ***
     *
     *    Optimize the code based on the following usage pattern. A very large list 
     *    of retailers is added at the very start of program execution. Then, the 
     *    functions mostPopularRetailer() and autocomplete() are called millions of times
     *    in rapid succession, with very few addRetailer() calls in between.
     *
     *    Try to minimize the time complexity of mostPopularRetailer() and autocomplete().
     *    Think of this as a server with a cache warmup time but then it'll serve a lot of 
     */   requests throughout the day.
     
     mostPopularRetailer in a Country
        Create an associative array with keys being the country names, and value equal to a sorted array of retailers by popularity. This would results in a time complexity of O(1) to find the most popoular retailer within a country. 
     
     autocomplete
        Create a binary search tree of retailers by Name. This would result in a time complexity of Olog(n) when searching for retailers with a name starting with the passed prefix.
        The BST search process could look something like: 
        
        function search($node, $autocomplete_prefix) {
            if ($node == null) return null;
            if (strpos(node.key, $autocomplete_prefix) === 0) {
                return node; //found
            } else if (strcmp($autocomplete_prefix, node.key)  < 0 ) {
                return search($node.left, $autocomplete_prefix); //Search left tree
            } else {
                return search($node.right, $autocomplete_prefix); //Search right tree
            }
        }
    
}
```

Javascript
=============

1. Given the following:



	```

	var a = 23;

	var outerFunction = function(inputVar) {
		var a = 5;
		var b = inputVar;

		return {
			increment: function() {
				a++;
				b++;
			},
			print: function() {
				console.log(a);
				console.log(b);
			}
		}
	}

	f = outerFunction(43);

	f.increment();
	f.print();
	console.log(a);


	

	```



	What is the output on the console?
	
        6
        44
        23



AngularJS
=============



1. In AngularJS, what do the $emit() and $broadcast() functions do?

    Both are means by which events can traverse through the scope hierarchy, notifying registered listeners on $rootScope.Scope.
    $emit starts at the scope where $emit was called, and traveses upwards towards the root scope, calling any registered listeners along the way.
    $broadcaset starts at the scope where $broadcast was called, and traverses downward toward any child scopes, calling any registered listeners along the way.




1. What is the difference between $scope and $rootScope?

    $rootscope is an object on the global scope. Therefore, it can be referenced anywhere within the application. $scope is an object accessible from current controller using it, and cannot be seen by other controllers.


1. Given the following AngularJS controller:



	```

		angular.module('exampleModule', [])

		.controller('scoreController', ['$scope', function($scope) {

			$scope.list = [

				{name: 'Lisa',  score: 95},

				{name: 'John',  score: 80},

				{name: 'Sean',  score: 60},

				{name: 'Sandy', score: 75},

				{name: 'Gary',  score: 45}

			];

		}]);

	```

	

	with the following html:

	

	```

	<body ng-app="exampleModule">

		<div ng-controller="scoreController">



		</div>

	</body>

	```

	

	a. Writing *only* in the html portion, output each student's name and score in a standard html list, *without* typing out all items manually. 

    <ul>
        <li ng-repeat="student in list">
            Name: {{student.name}}, Score: {{student.score}}
        </li>
    </ul>

	

	b. Change the above to only output students with a score of 75 or greater, and sort the results by score, with the highest score first.

    <ul>
        <li ng-repeat="student in list | orderBy: '-score'" ng-if="student.score >= 75">
            Name: {{student.name}}, Score: {{student.score}}
        </li>
    </ul>

	

1. Given the following AngularJS application:



	```

	<html>

	<head>

		<title>Example</title>

	  

		<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.min.js"></script>

		<script>



			angular.module('exampleModule', [])

			.controller('messageController', ['$scope', function($scope) {

				$scope.message = '';

			}])



		</script>

	  

	</head>

	<body ng-app="exampleModule">

		<div ng-controller="messageController">

			Input: <input ng-model="message" />

			

			<button>Submit</button>

			<button>Clear</button>

			

			<br/>

			

			<div>Message: {{message}}</div>

		</div>

	</body>

	</html>

	```

	

	a. What does this application do/show?

        This application presents the end user with an input where they can supply text, which is then mirrored in a div below the control and buttons.

	    

	b. Re-write this code so that the text next to `Message: ` does not update right away, but only when the user clicks the **Submit** button. Also, when the user clicks the **Clear** button, the message should update to an empty string.

        <html>
        
        <head>
        
            <title>Example</title>
        
        
            <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.min.js"></script>
        
            <script>
        
        
                angular.module('exampleModule', [])
        
                    .controller('messageController', ['$scope', function ($scope) {
        
                        $scope.message = '';
                        $scope.view_message = '';
        
                    }])
        
        
            </script>
        
        
        </head>
        
        <body ng-app="exampleModule">
        
            <div ng-controller="messageController">
        
                Input: <input ng-model="message"/>
        
        
                <button ng-click="view_message = message">Submit</button>
        
                <button ng-click="view_message = ''">Clear</button>
        
        
                <br/>
        
        
                <div>Message: {{view_message}}</div>
        
            </div>
        
        </body>
        
        </html>
        





	