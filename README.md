# php-template
Dead simple php templates 

## Example usage
```php
// Start your engine
$templates = new Engine('path_to_template_files');
//get a file
$template = $templates->get('filename.php');
// Output
echo $template->render();
// Or you can cast the template to a string
echo (string) $template
```

## Variable binding
There are 2 levels where you can add a variable: the Engine can hold variables that are shared across templates, while the Template can hold variables specific for this template.

Note: we use extract() to get parse the variables!
```php
// Start your engine
$templates = new Engine('path_to_template_files');

// bind a single variable
$templates->bind('foo', 'bar');
// or bind multiple variables using an array:
$templates->bind(['foo'=>'bar', 'foo_1'=>'bar_1');


//For a specific file. Not that $template inherits the variables from $templates
$template = $templates->get('filename.php');
$template->bind('foo', 'bar');
```

## Template files
Inside your template files you can use html. To include another file use 
```php
$this->get('partials/filename.php', $optional_data_array);
```

The partial will inherit variables bound to the Engine, the Template and anything passed in $optional_data_array