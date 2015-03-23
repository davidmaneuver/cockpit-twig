# Cockpit-Twig

Use Cockpit and Twig together.

- http://getcockpit.com
- https://github.com/aheinze/cockpit
- http://twig.sensiolabs.org

### Installation

1. Download zip and unpack to 'your_cockpit_folder/modules/addons/twig'.
2. Make sure you require 'your_cockpit_folder/bootstrap.php'.
3. Hook up your Twig_Environment to the module.

  ```php
  cockpit('twig')->use($your_twig_env);
  ```

4. Start using Cockpit in your templates.

### Initialisation Example

```php
define('DOCROOT', $_SERVER['DOCUMENT_ROOT']);
require_once('vendor/autoload.php'); // If you're using composer.
require_once('cockpit/bootstrap.php');

// Setup Twig templating engine
$loader = new Twig_Loader_Filesystem(DOCROOT . '/templates');
$twig = new Twig_Environment($loader, array(
  'cache' => DOCROOT . '/cache',
));

cockpit('twig')->use($twig);

$template = $twig->loadTemplate('index.twig'); // Make sure '/templates/index.twig' exists.
echo $template->render();
```

### Usage

#### Collections

Retrieve all items for a collection:

```php
{% for item in collection('projects') %}
  {{ item.name }}
{% endfor %}
```

Query a collection:

```php
{% for item in collection('projects', {active: 1}) %}
  {{ item.name }}
{% endfor %}
```

#### Regions

```php
{{ region('info') }}
```

#### Galleries & Mediamanager

```php
{% for image in gallery('projects') %}
  {{ thumbnail(image.path) }}
{% endfor %}
```

#### Forms

```php
{{ form('contact') }}
  <input type="text" name="form[name]" />
  <input type="email" name="form[email]" />
  <input type="submit" value="submit" />
</form>
```

## Copyright and license

Copyright 2014 [maneuver](http://www.maneuver.be) under the MIT license.
