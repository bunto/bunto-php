# Contribute

So you've got an awesome idea to throw into Bunto. Great! Please keep the
following in mind:

* **Use Gitter for non-technical or indirect Bunto questions that are not bugs.**
* **Contributions will not be accepted without tests or necessary documentation updates.**
* If your contribution changes any Bunto behavior, make sure to update the
  documentation. It lives in `site/_docs`. If the docs are missing information,
  please feel free to add it in. Great docs make a great project!
* Please do your best to submit **small pull requests**. The easier the proposed
  change is to review, the more likely it will be merged.
* When submitting a pull request, please make judicious use of the pull request
  body. A description of what changes were made, the motivations behind the
  changes and [any tasks completed or left to complete](http://git.io/gfm-tasks)
  will also speed up review time.

## Workflow

Here's the most direct way to get your work merged into the project:

* Fork the project.
* Clone down your fork ( `git clone git@github.com:[username]/bunto.git` ).
* Create a topic branch to contain your change ( `git checkout -b my_awesome_feature` ).
* Hack away, add tests. Not necessarily in that order.
* Make sure everything still passes with Travis CI.
* If necessary, rebase your commits into logical chunks, without errors.
* Push the branch up ( `git push origin my_awesome_feature` ).
* Create a pull request against bunto/bunto and describe what your change
  does and the why you think it should be merged.

## Updating Documentation

We want the Bunto documentation to be the best it can be. We've
open-sourced our docs and we welcome any pull requests if you find it
lacking.

All documentation pull requests should be directed at `master`. Pull
requests directed at another branch will not be accepted.

The [Bunto wiki](https://github.com/bunto/bunto/wiki) on GitHub
can be freely updated without a pull request as all GitHub users have access.

## Gotchas

* Please do not bump the gem version in your pull requests.
* Try to keep your patch(es) based from the latest commit on bunto/bunto.
  The easier it is to apply your work, the less work the maintainers have to do,
  which is always a good thing.
* Please don't tag your GitHub issue with [fix], [feature], etc. The maintainers
  actively read the issues and will label it once they come across it.

## Finally...

Thanks! Hacking on Bunto should be fun. If you find any of this hard to figure
out, let us know so we can improve our process or documentation!
