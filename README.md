Herbert Rewrite
===============

> **Note:**  This is a quick and dirty readme. I will update this tonight 9th Feb.

Welcome to the Herbert rewrite branch. This version of Herbert is aimed at solving this issue:

https://github.com/getherbert/herbert/issues/7

The first version of the framework could not be run in conjunction with another plugin also using Herbert. We've solved this by only allowing one instance of the framework to load. Therefore one instance handles all plugins needing it. Plugins are now required to have a namespace.

If only once instance of Herbert is allowed to run then it proposes a problem for example:
```
Plugin 1 uses Herbert vX
Plugin 2 uses Herbert vY
```

In this case if Herbert vX doesn't have a method or support Plugin 2 requires then it would cause errors. This rewrite doesn't include our solution for this. We suggest, if everyone agrees, that we namespace versions. Like so:
```
Herbert\Framework\vX
```

Therefore in the above situation one instance of Herbert vX & vY would run.

## Other Improvements

* The framework is now separate and pulled in by composer.
* Removed Traits and now use the `Container` from `Illuminate/Support`
* Being able to override Twig Provider
* Herbet/Herbert Slim

## Feedback

We want to know if this is the right direction for the framework so please let us know what you think.
