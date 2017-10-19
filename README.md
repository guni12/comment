Anax comment
==================================

[![Latest Stable Version](https://poser.pugx.org/guni12/comment/v/stable)](https://packagist.org/packages/guni12/comment)
[![Build Status](https://travis-ci.org/guni12/comment.svg?branch=master)](https://travis-ci.org/guni12/comment)
[![CircleCI](https://circleci.com/gh/guni12/comment.svg?style=svg)](https://circleci.com/gh/guni12/comment)
[![Build Status](https://scrutinizer-ci.com/g/guni12/comment/badges/build.png?b=master)](https://scrutinizer-ci.com/g/guni12/comment/build-status/master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/guni12/comment/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/guni12/comment/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/guni12/comment/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/guni12/comment/?branch=master)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/d831fd4c-b7c6-4ff0-9a83-102440af8929/mini.png)](https://insight.sensiolabs.com/projects/d831fd4c-b7c6-4ff0-9a83-102440af8929)

(Anax) guni12 comment module.



Install
------------------

Install using composer and then integrate the module with your Anax installation.



### Install with composer

```
composer require guni12/comment
```


### Router files

```
rsync -av vendor/guni12/comment/config/route/commController.php config/route
```


### DI services

Add the services di configuration.
Make sure you have the directory `config/di`

```
rsync -a vendor/guni12/comment/config/di.php config/di/comment.php
```


### View files

You have the directory `view/comm`

```
rsync -av vendor/guni12/comment/view/comm/crud* view/comm
```


You might want to change namespace and place the src-files amongst your own src-files.




License
------------------

This software carries a MIT license.



```
 .  
..:  Copyright (c) 2017 Gunvor Nilsson (gunvor@behovsbo.se)
```
