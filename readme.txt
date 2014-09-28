or create a new repository on the command line

	touch README.md
	git init
	git add README.md
	git commit -m "first commit"
	git remote add origin https://github.com/dotuian/manage.git
	git push -u origin master


or push an existing repository from the command line
	git remote add origin https://github.com/dotuian/manage.git
	git push -u origin master



CREATE USER ＜用户名＞ IDENTIFIED BY '＜密码＞';
GRANT SELECT,INSERT,UPDATE,DELETE,CREATE,DROP
    ON bankaccount.*
    TO 'custom'@'localhost'
    IDENTIFIED BY 'obscure';
GRANT SELECT,INSERT,UPDATE,DELETE,CREATE,DROP
    ON expenses.*
    TO 'custom'@'whitehouse.gov'
    IDENTIFIED BY 'obscure';
GRANT SELECT,INSERT,UPDATE,DELETE,CREATE,DROP
    ON customer.*
    TO 'custom'@'server.domain'
    IDENTIFIED BY 'obscure';
