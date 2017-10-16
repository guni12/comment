Anax comment
==================================

[![Latest Stable Version](https://poser.pugx.org/anax/comment/v/stable)](https://packagist.org/packages/anax/comment)
[![Join the chat at https://gitter.im/mosbth/anax](https://badges.gitter.im/Join%20Chat.svg)](https://gitter.im/canax?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)
[![Build Status](https://travis-ci.org/canax/comment.svg?branch=master)](https://travis-ci.org/canax/comment)
[![CircleCI](https://circleci.com/gh/canax/comment.svg?style=svg)](https://circleci.com/gh/canax/comment)
[![Build Status](https://scrutinizer-ci.com/g/canax/comment/badges/build.png?b=master)](https://scrutinizer-ci.com/g/canax/comment/build-status/master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/canax/comment/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/canax/comment/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/canax/comment/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/canax/comment/?branch=master)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/d831fd4c-b7c6-4ff0-9a83-102440af8929/mini.png)](https://insight.sensiolabs.com/projects/d831fd4c-b7c6-4ff0-9a83-102440af8929)

Anax comment module.



Install
------------------

Install using composer and then integrate the module with your Anax installation.



### Install with composer

```
composer require guni12/comment
```


### Router files

```
rsync -av vendor/anax/comment/config/route/commController.php config/route
```

You need to include the router file in your router configuration `config/route.php`. There is a sample you can use in `vendor/anax/comment/config/route.php`.



### DI services

You need to add the services di configuration `config/di.php`. There is a sample you can use in `vendor/anax/comment/config/di.php`.


### view files
You need some view files

```
rsync -av vendor/anax/comment/view/comm/crud* view/comm/crud
```


You might want to change namespace and place the src-files in your own src-files area.




License
------------------

This software carries a MIT license.



```
 .  
..:  Copyright (c) 2017 Gunvor Nilsson (gunvor@behovsbo.se)
```
