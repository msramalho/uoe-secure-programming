# 2. Secure Coding

## 1
The program **vulnerable** is a SET_UID program that tries to write to `board1` which is a root-owned file that is inside a folder that is user-owned (meaning the user has write permission for that folder) this in turn means the user can delete/change the `board1` file. 
Should the user decide, she can update `board1` to be a symbolic link to `board2` (the one that the messages should not go to) and thus the execution of the vulnerable code will result in writing directly to `board2`. 
In fact, the user could do even more malicious things since **vulnerable** is a SETU_UID program it will run with root privileges and could even access or modify other files, add users, and more malicious actions. 

This is a case of _Improper Access Control_ ([CWE-284](https://cwe.mitre.org/data/definitions/284.html)). 

## 2
The following script has been created:
```bash
#!/bin/bash

ln -sf ./board2 ./board1

eval $1 "attacker" "pwned message"
```
When copying this file to the `/home/user/exploit` folder the script needs to be given execution permission for `user` this can be achieved with `chmod u+x ./exploit`


## 3
The above script simply creates a symbolic link from `board1` to `board2` using regular user permissions (since the user has write access to the `exploit` folder) and then executes the passed program (`./vulnerable` that is expected to be in the same folder as `board1` and `board2`).

This will result in `vulnerable` writing the message `"pwned message"` to `board2`.

As for the username `"attacker"` and message `"pwned message"`, they were constants chosen without any specific reason except having less than 50 chars so they would not get trimmed.

## 4
Note: The patch fixes the above problem, but leaves the final program still vulnerable to race-condition attacks. This is out of scope of this task, but could be achieved using [seteuid](http://man7.org/linux/man-pages/man2/seteuid.2.html)

## 5
### Vulnerability 1
#### Description
#### Exploit
#### Consequences

### Vulnerability 2
#### Description
#### Exploit
#### Consequences

### Vulnerability 3
#### Description
#### Exploit
#### Consequences
