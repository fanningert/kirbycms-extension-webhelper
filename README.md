# Kirby Extension - WebHelper
A collection of little helper for usage in Kirby

## Installation

### GIT

Go into the `{kirby_installation}/site/plugins` directory and execute following command.

```bash
$ git clone https://github.com/fanningert/kirbycms-extension-webhelper.git
```

### GIT submodule

Go in the root directory of your git repository and execute following command to add the repository as submodule to your GIT repository.

```bash
$ git submodule add https://github.com/fanningert/kirbycms-extension-webhelper.git ./site/plugins/kirbycms-extension-webhelper
$ git submodule init
$ git submodule update
```

### Manuell

## Update

### GIT

Go into the `{kirby_installation}/site/plugins/kirbycms-extension-webhelper` directory and execute following command.

```bash
$ git pull
```

### GIT submodule

Go in the root directory of your git repository and execute following command to update the submodule of this extension.

```bash
$ git submodule update
```

## TODO

* All function: Add config parameter to selectiv activate a function (KirbyTag)
* Function `age`: Add optional Attributes for dateformat and timezone
* Function `messagebox`: Add config parameter to define the the prefix for class (Default: `alert`)

## Content

### Messages boxes

Generel the tags works in two versions.

**Simple tag**

```kirbytag
(message_type: text)
```

**Complex tag**

```kirbytag
(message_type)
text
(/message_type)
```

#### Information messages

##### Kirby

```kirbytag
(info: This is an important information.)
```

##### PHP

```php
$text = "This is an important information.";
at\fanninger\kirby\extension\webhelper\WebHelper::messageboxInformation( $text );
```
##### Output

```html
<div class="alert alert-info">This is an important information.</div>
```

#### Success messages

##### Kirby

```kirbytag
(success: Hooooray! This messages says that operation succeeded!!)
```

##### PHP

```php
$text = "Hooooray! This messages says that operation succeeded!!";
at\fanninger\kirby\extension\webhelper\WebHelper::messageboxSuccess( $text );
```

##### Output

```html
<div class="alert alert-success">Hooooray! This messages says that operation succeeded!!</div>
```

#### Warning messages

##### Kirby

```kirbytag
(warning: Now this is a warning! One more click and you`ll face the consequences!)
```

##### PHP

```php
$text = "Now this is a warning! One more click and you`ll face the consequences!";
at\fanninger\kirby\extension\webhelper\WebHelper::messageboxWarning( $text );
```

##### Output

```html
<div class="alert alert-warning">Now this is a warning! One more click and you`ll face the consequences!</div>
```

#### Error messages

##### Kirby

```kirbytag
(error: Oooops, this is an error message. You know what that means.)
```

##### PHP

```php
$text = "Oooops, this is an error message. You know what that means.";
at\fanninger\kirby\extension\webhelper\WebHelper::messageboxError( $text );
```

##### Output

```html
<div class="alert alert-error">Oooops, this is an error message. You know what that means.</div>
```

#### Validation messages

##### Kirby

```kirbytag
(validation: First name is a required field)
```

##### PHP

```php
$text = "First name is a required field";
at\fanninger\kirby\extension\webhelper\WebHelper::messageboxValidation( $text );
```

##### Output

```html
<div class="alert alert-validation">First name is a required field</div>
```

### Figure

#### Simple example

```kirbytag
(figure caption: text)
content
(/figure)
```

Output
```html
<figure>
  content
  <figcaption>text</figcaption>
</figure>
```

#### Caption top

```kirbytag
(figure: text caption_top: true class: test-class)
content
(/figure)
```

Output
```html
<figure class="test-class">
  <figcaption>text</figcaption>
  content
</figure>
```

### Calulcate age

##### Kirby

```kirbytag
(age: 21/01/1972)
```

##### PHP

```php
$dayOfBirth = '21/01/1972';
$dateFormat = 'd/m/Y';         //Optional
$timezone = 'Europe/Brussels'; //Optional
at\fanninger\kirby\extension\webhelper\WebHelper::calcAge($dayOfBirth, $dateFormat, $timezone);
```
