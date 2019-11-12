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

