<h1><b>Sapling</b></h1>
<p>
  A small PHP framework that implements MVC design pattern. This framework is
  created with the intent to give the author knowledge about php and at the same
  time be usable.
</p>
<h1><b>Installation</b></h1>
<ul>
  <li>
    <pre>git clone https://github.com/ShiniDev/Sapling.git</pre>
  </li>
  <li>
    <pre>composer install</pre>
  </li>
  <li>
    <pre>composer update</pre>
  </li>
</ul>
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
    $this->table('tablename'); // sets the table to get data from
    $this->insert(['columns'], ['datas']); // tells what columns and corresponding data
</pre>
<h3><b>Example Select Query</b></h3>
<pre>
    $this->table('tablename');
    $this->whereMany(['columns'], ['values']);
    // or
    $this->whereSpecific('column', value, '!=');
    // or
    $this->whereManual("WHERE column = ?", [values]);
</pre>
