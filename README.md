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

```kirbytag
(info: This is an important information.)
```

Output
```html
<div class="messagebox messagebox-info">This is an important information.</div>
```

##### PHP

```php
$text = "This is an important information.";
at\fanninger\kirby\extension\webhelper\WebHelper::messageboxInformation( $text );
```

#### Success messages

```kirbytag
(success: Hooooray! This messages says that operation succeeded!!)
```

Output
```html
<div class="messagebox messagebox-success">Hooooray! This messages says that operation succeeded!!</div>
```

##### PHP

```php
$text = "Hooooray! This messages says that operation succeeded!!";
at\fanninger\kirby\extension\webhelper\WebHelper::messageboxSuccess( $text );
```

#### Warning messages

```kirbytag
(warning: Now this is a warning! One more click and you`ll face the consequences!)
```

Output
```html
<div class="messagebox messagebox-warning">Now this is a warning! One more click and you`ll face the consequences!</div>
```

##### PHP

```php
$text = "Now this is a warning! One more click and you`ll face the consequences!";
at\fanninger\kirby\extension\webhelper\WebHelper::messageboxWarning( $text );
```

#### Error messages

```kirbytag
(error: Oooops, this is an error message. You know what that means.)
```

Output
```html
<div class="messagebox messagebox-error">Oooops, this is an error message. You know what that means.</div>
```

##### PHP

```php
$text = "Oooops, this is an error message. You know what that means.";
at\fanninger\kirby\extension\webhelper\WebHelper::messageboxError( $text );
```

#### Validation messages

```kirbytag
(validation: First name is a required field)
```

Output
```html
<div class="messagebox messagebox-validation">First name is a required field</div>
```

##### PHP

```php
$text = "First name is a required field";
at\fanninger\kirby\extension\webhelper\WebHelper::messageboxValidation( $text );
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

```kirbytag
(age: 21/01/1972)
```

TODO: Add parameter for Timezone and dateformat

##### PHP

```php
at\fanninger\kirby\extension\webhelper\WebHelper::calcAge($dayOfBirth, [dateformat], [Timezone]);
```
