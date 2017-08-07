---
title: "Upgrade Guide"
category: "Miscellaneous"
order: 20
---

> Checkout the [Upgrade Guide]({{ site.baseurl }}{% link _docs/miscellaneous/upgrade-guide.md %}).




## Upgrade from `4.1` to `5.0`:


















## How to upgrade older versions of Apiato?


##### Upgrading method:

1) Setup an upstream remote (to point to your fork of the apiato repository)

`git remote add upstream git@github.com:username/apiato.git`

```shell
❯ git remote -vv
origin      git@bitbucket.org:username/project-a.git (fetch)
origin      git@bitbucket.org:username/project-a.git (push)
upstream    git@github.com:apiato/apiato.git (fetch)
upstream    git@github.com:apiato/apiato.git (push)
```

2) Create apiato branch

`git checkout -b apiato`

3) Let the apiato branch track the upstream master branch

`git branch --set-upstream-to upstream/master`

```shell
❯ git branch -vv
 apiato          77b4d945 [upstream/master] ...
 master          77d302aa [origin/master] ...
```

4) Now you can move the updates to your master branch in 2 ways:


**Option A**: merge the entire apiato branch with master and solve the conflicts manually. *(easier and faster)*

`git checkout master`

The git merging can be done in many ways:

- Merge then solve the conflict manually `git merge --allow-unrelated-histories apiato` *(recommended)*
- Merge and keep your project changes `git merge --allow-unrelated-histories -X ours apiato`
- Merge and overwrite your project with the apiato changes `git merge --allow-unrelated-histories -X theirs apiato`


*-X is a shortcut for --strategy-option=*




**Option B**: Manually cherry pick from apiato to master only the commits you need:

`git checkout master`

`git log apiato`      (to copy each commit ID, one by one)

`git cherry-pick {commit-ID}`      (if you get any conflict solve it and keep moving)

<br>

Checkout the project setup in [Contributing to APIATO]({{ site.baseurl }}{% link _docs/miscellaneous/contribution.md %}).


