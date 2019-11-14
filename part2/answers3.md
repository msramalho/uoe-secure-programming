## Used tools
<!-- linux packages, browser plugins, ... -->
* scp to get/send files into the VM over ssh
* ssh-keygen to generate the private/public key pair
* ssh-copy-id to copy the public ssh key into the VM
* 
## Modified NAT rules
<!-- configurable in the VB machine settings > network -->

## 3.1 OpenSSH Configuration
### a
1. added `AllowUsers user` to the `/etc/ssh/sshd_config` file to make `user` the only account that can login through ssh
2. restarted the server with `sudo systemctl restart sshd`

### b
1. generated a private/public rsa key pair with `ssh-keygen`
2. copied the public key into the VM with `ssh-copy-id` (copies the id_rsa.pub into ~/.ssh/authorized_keys)
3. uncommented and changed  `# PasswordAuthentication yes` to `PasswordAuthentication no` in the `/etc/ssh/sshd_config` file to force the ssh login to happen only through rsa key mechanism
4. restarted the server with `sudo systemctl restart sshd`

For this to work, the `id_rsa.pub` file must be copied to the `/home/.ssh/authorized_keys` file. 

Note: the `authorized_keys` file was changed according to the machine from which the rsa key was copied which was a DICE computer, kranjeck, in this case. 

## 3.2 Fun with Heartbleed
### a
The Heartbleed bug will allow an attacker to access memory values that he should not have access to.
After establishing an SSL connection with the vulnerable server, an attacker will send a heartbeat request (this is a feature implemented to guarantee that the connection is still alive and also to avoid the connection from breaking by being idle for too long). What happens if the server is vulnerable is that upon requesting a heartbeat from the server, the user can will send a message and also the size of that message, if the attacker specifies a length greater than the real message sent, the vulnerable server will read the extra characters (max 64Kb) from memory. This heartbeat request can be performed multiple times and this will likely result in leaking different information from the server memory. 

Naturally, the consequences involve data being compromised, and this data can be anything from password, private key files and so on. 

To test the VM's vulnerability I took the following steps:
1. started the openssl service with `openssl s_server -key /home/user/key/key.pem -cert /home/user/key/cert.pem -accept 12345 -www`
2. used a python PoC script available [on GitHub](https://github.com/ctfs/write-ups-2014/blob/master/plaid-ctf-2014/heartbleed/heartbleed.py) to test with the following command `python heartbleed.py localhost -p 54321` and got the confirmation

### b
The steps taken to fix the bug were:
1. find and analyse the patches done by the openssl community available [here](https://github.com/openssl/openssl/commit/96db9023b881d7cd9f379b0c154650d6c108e9a3)
2. identify the file that implements the TLS heartbeat mechanism: `ssh/t1_lib.c`
3. identify where the bounds check is missing in the heartbeat logic that allows for heartbleed (looking for `#ifndef OPENSSL_NO_HEARTBEATS` helped). The function in question is `int tls1_process_heartbeat(SSL *s)` (line 2554)
4. introduce the bounds check to test that the length of the heartbeat request is within bounds
5. recompiled and tested again with the same tools as described in the previous section and received a `Server likely not vulnerable`message
6. created the diff for the `ssl/t1_lib.c` file


## 3.3 

Changed files: /etc/php/php.ini, /etc/httpd/conf/httpd.conf
`scp -P2222 ./httpd.conf user@localhost:/etc/httpd/conf/httpd.conf`
