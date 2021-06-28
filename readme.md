<h1><b>Sapling</b></h1>
<p>
  A small PHP framework that implements MVC design pattern. This framework is
  created with the intent to give the author knowledge about php and at the same
  time be usable for the community.
</p>
<h1><b>Installation</b></h1>
<pre>git clone https://github.com/ShiniDev/Sapling.git</pre>
<pre>composer install</pre>
<pre>composer update</pre>
<h1><b>Configuration</b></h1>
<h2><b>.envtemplate</b></h2>
<p>
  You can edit the .envtemplate file to correspond to your database
  configuration, after editing it create a copy and name it .env. It is what
  Sapling reads for your database configurations. You should not include your
  .env file when uploading your repository to github.
</p>
<h2><b>config/Debug.php</b></h2>
<p>
  In here you can enable Sapling's error reporting. Sapling's error reporting is
  on by default. DEVELOPMENT, when true displays error. STRICT, when true kills
  the application if there are errors. Note, that this is seperate from php
  error reporting, if you want to enable php error reporting go to your .env
  file and set DEVELOPMENT to "TRUE".
</p>
<h2><b>config/Routes.php</b></h2>
<p>
  In here you can set your base url, default controller, default function and
  error page directory.
</p>
<h1><b>Usage</b></h1>
<h2><b>src/App/Controller</b></h2>
<p>This is where you're gonna load your models and views.</p>
<h3><b>Loading a Model</b></h3>
<pre>$this->loadModel('modelFile', 'optionalname')</pre>
<h3><b>Using a loaded model</b></h3>
<pre>$this->ModelFile->function() or $this->OptionalName->function()</pre>
<h3><b>Loading a view</b></h3>
<pre>$this->loadView('viewFile', 'optionalData')</pre>
<h2><b>src/App/Model</b></h2>
<p>
  This is where you're going to communicate to your database. Model classes is
  recommended to extend the QueryBuilder class.
</p>
<h3><b>Example Insert Query</b></h3>
<pre>
    $this->table('tablename'); // sets the table to insert data to 
    $this->insert(['columns'], ['datas']); // tells what columns and corresponding data
    // Insert only needs a table name
</pre>
<h3><b>Example Select Query</b></h3>
<pre>
    $this->table('tablename'); // sets the table to get data from
    $this->whereMany(['columns'], ['values']); // Sets the where clause based on the given columns and values
    // or
    $this->whereSpecific('column', value, '!='); // Appends and sets the specific column and its value one by one.
    // or
    $this->whereManual("WHERE column = ?", [values]); // Set the where clause manually.
    $this->join('left', 'tablename', 'on condition'); // Joins tables
    $this->order('column'); // Order by column
    $this->limit(100); // Limits result
    $this->select(['columns']); // Selects columns
    // Select only needs a table, all the others are optional
</pre>
<h3><b>Example Update Query</b></h3>
<pre>
    $this->table('tablename'); // sets the table to get data from
    $this->whereMany(['columns'], ['values']); // Sets the where clause based on the given columns and values
    // or
    $this->whereSpecific('column', value, '!='); // Appends and sets the specific column and its value one by one.
    // or
    $this->whereManual("WHERE column = ?", [values]); // Set the where clause manually. 
    // It is necessary to have always setted the where clause or else Sapling will display error
    $this->update(['columns'], [values]);
</pre>
<h3><b>Example Delete Query</b></h3>
<pre>
    $this->table('tablename'); // sets the table to get data from
    $this->whereMany(['columns'], ['values']); // Sets the where clause based on the given columns and values
    // or
    $this->whereSpecific('column', value, '!='); // Appends and sets the specific column and its value one by one.
    // or
    $this->whereManual("WHERE column = ?", [values]); // Set the where clause manually. 
    // It is necessary to have always setted the where clause or else Sapling will display error
    $this->delete();
    // Deletes rows based on the where clause that is setted.
</pre>
<h3><b>Getting the builded query</b></h3>
<pre>
    $this->getLastQuery(); // returns a string
</pre>
<h2><b>Url Helper</b></h2>
<h3><b>Getting the base url</b></h3>
<pre>Url::baseUrl();</pre>
<h3><b>Redirecting</b></h3>
<pre>Url::redirect(url);</pre>
<h2><b>Passing parameters to controller</b></h2>
<pre>
  http://localhost/Sapling/controller/method/param1/param2/param3
  // The url above passes 3 parameters to a controller function.
  public function test(param1, param2, param3); // Your controller method
</pre>
<h2><b>Loading resources</b></h2>
<h3><b>Loading a css file in a view php</b></h3>
<pre>'<link rel="stylesheet" type="text/css" href="<?= Url::baseUrl() ?>resources/css/test.css">'</pre>
<h3><b>Loading a js file in a view php</b></h3>
<pre>'<script src="<?= Url::baseUrl() ?>resources/js/test.js"></script>'</pre>
<h1><b>Notes</b></h1>
<p>
  Test.php controller and TestModel.php only exists to serve as an example on
  how to use a controller and a model in Sapling. Database are not needed as
  long as you don't load a model in your controller.
</p>
<h1><b>Current Features</b></h1>
<ul>
  <li>Url Routing</li>
  <li>Security against script access</li>
  <li>Secured database credentials</li>
  <li>Simple debugger</li>
  <li>Flexible query builder</li>
  <li>Simple folder structure</li>
  <li>Easy to use and understand</li>
  <li>Documented</li>
</ul>
<h1><b>Features to learn/add</b></h1>
<ul>
  <li>Better routing implementation, similar to of Laraval or Codeigniter</li>
  <li>API implementation</li>
</ul>
