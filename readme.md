<h1><b>Sapling</b></h1>
<h2>Author</h2>
<p>ShiniDev</p>
<h2>Description</h2>
<h3>What is Sapling?</h3>
<p>
Sapling is a tiny php framework implemented by ShiniDev. Sapling represents his
characteristics which is to grow.</p>
<h2>How to use?</h2>
<h3>Installation</h3>
<code>cd YourProjectDirectory</code>
<br>
<code>git clone https://github.com/ShiniDev/Sapling.git</code>
<br>
<code>cd Sapling</code>
<br>
<code>composer install</code>
<br>
<code>composer update</code>
<br>
<h3>Model Functions</h3>
<p>I have set up the four basic sql queries which is select,insert,delete and
update to use them look at the example below:<br>
<h4>Select</h4>
In your model class you can call, <code>$this->get("table_name");</code>, this
will select all the rows from the specified table, to get specific columns only
you can call, <code>$this->get("table_name", ["column_1", "column_2"...])</code><br>
<h4>Insert</h4>
<code>$this->insert("table_name", [val_1,val_2...])</code>, where the values are
the data that you want to insert to the table <h4>Delete</h4>
Delete specific row, <code>$this->delete("table_name", $column_field,
$column_value)</code>, to have multiple deletions you can call,
<code>$this->deleteMany("table_name", $columns, $values, $use_and)</code>, the
fourth parameter decides wether to use OR or AND to the where clauses. 
<h4>Update</h4> <code>$this->update("table_name", $update_column, $update_value,
$where_column, $where_value)</code><br>
For more examples you can look at my Test_model.php for all the demonstrations.
<h3>Setting up your configurations</h3>
<p><b>Directories.php</b>, change this if you want to change the directory
structure of the app</p> 
<p><b>Routes.php</b>, here you can set the default controller to call and the
default function to call, you can also set where to redirect error pages or
custom error pages.</p>
<h3>Setting up your database</h3>
<p>
To set up your database, look at the .envtemplate and change each lines to match your database<br>
After that, create a copy of your modified .envtemplate and rename it to .env<br>
Example:<br>
</p>
<h3>Url format</h3>
<h4><code>server_url/Controller/Function/Params</code>..., complete url format</h4>
<h4><code>server_url</code>, calls the default controller and default function</h4>
<h4><code>server_url/Controller</code>, calls the default function</h4>
<h4><code>server_url/Controller/Function/Param1/Param2/Param3</code>,
multiple parameter for a specific function</h4>
<h3>Important</h3>
<p>If your controller is going to take in parameters, always make sure that
there's only one parameter, the parameter that gets passed is an array which is
numerically indexed.</p>
<h3>Controller Functions</h3>
<h4>Loading a model class</h4>
<p>You can load model class through the function
<code>$this->loadModel("ModelName")</code>, which then the model functions can be
accessed using,<code>$this->ModelName->function()</code></p>
<h4>Loading a view page </h4>
<p>You can load view page through the function
<code>$this->loadView("view_page", $your_data)</code>.</p>
<p><b>Note: that the loadView function can only load .php files</b></p>
<h2>Current Features</h2>
<ul>
    <li>Basic url routing</li>
    <li>MVC project structure</li>
    <li>Security against script access, via htaccess and php</li>
</ul>
<h2>Planned Features</h2>
<ul>
    <li>Add 3rd party libraries via composer</li>
    <li>Add more core classes</li>
</ul>
<h2>Goals</h2>
<ul>
    <li>Implement a tiny php framework</li>
    <li>Implement basic php framework features</li>
    <li>Security with apache htaccess configuration</li>
    <li>Planning, design patterns, and robust implementation</li>
    <li>And lastly, learn a lot!</li>
</ul>
