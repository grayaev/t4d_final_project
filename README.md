<h3 style="text-align:left">Установка Wordpress в облаке</h3>

<ul>
	<li style="text-align:left">Архитектура проекта:</li>
	<li style="text-align:left">Балансировщик Nginx - 1</li>
	<li style="text-align:left">Сервер приложений wordpress - 2</li>
	<li style="text-align:left">База данных - 1</li>
	<li style="text-align:left">Сервер бэкапов - 1</li>
</ul>

<p><strong>Требования к ВМ - ubuntu 20.04 1Cpu 2Gb 6шт</strong></p>

<p><strong>Подготовка к установке:</strong></p>

<p style="text-align:left">Форкаем себе репозиторий <a href="https://github.com/grayaev/t4d_final_project">https://github.com/grayaev/t4d_final_project</a></p>

<p>в папке .github/workflows находятся две задачи для github actions</p>

<p>telegram.yml - отвечает за отправку сообщений в telegram</p>

<p>deploy_ansible.yml - отвечает за раскатку приложений на сервера</p>

<p>если задачи не появились в в панели &quot;Actions&quot; - просто копируем их содержимое и создаем задачи в &quot;Actions&quot;, называть можно как угодно</p>

<p><strong>Установка:</strong></p>

<p><strong>1) Настраиваем отправку сообщений по пушу/пулу в телеграм канал</strong></p>

<p>в файле .github/workflows/telegram.yml в переменные записываем:</p>

<ul>
	<li><strong>to:</strong> <u>-1111111111</u> chat_id &nbsp;#(<em>телеграм канала</em>)</li>
	<li><strong>token:</strong> <u>11111111111:asdfbsdtnetmnsthshtsnsnsmyshshrth</u>&nbsp; #(<em>токен созданного вами бота</em>)</li>
</ul>

<p><strong>2) Настраиваем окружение для .github/workflows/deploy_ansible.yml</strong></p>

<p>Для успешного запуска автоматической установки приложений нам понадобятся:</p>

<p><strong>ключевая пара ssh</strong></p>

<ul>
	<li style="list-style-type:none">
	<ul>
		<li><strong>cd ~ &amp;&amp; mkdir mykey</strong>&nbsp;создаем папку в которой будем хранить ключи</li>
		<li><strong>ssh-keygen -t rsa -f mykey/my_key&nbsp;</strong>создаем ключи, которые будем использовать далее</li>
		<li>приватный ключ&nbsp;<strong>my_key&nbsp;</strong>открываем в текстовом редакторе и копируем содержимое</li>
		<li>На главной странице прокта github переходим в<span style="color:#2980b9">&nbsp;<strong>Settings &gt; Secrets &gt; Actions</strong>&nbsp;</span>далее жмем кнопку <span style="color:#2980b9"><strong>New Repository Secret</strong></span></li>
		<li>в Name пишем DO_SSH_KEY</li>
		<li>в Value вставляем скопированный ранее ключ</li>
		<li>сохраняем</li>
	</ul>
	</li>
</ul>

<p><strong>выдумать логин и пароль для базы данных mysql и записать их в сикреты проекта github</strong></p>

<ul>
	<li>На главной странице прокта github переходим в<span style="color:#2980b9">&nbsp;<strong>Settings &gt; Secrets &gt; Actions</strong>&nbsp;</span>далее жмем кнопку <span style="color:#2980b9"><strong>New Repository Secret&nbsp;</strong></span></li>
	<li>в Name указываем DB_SECRET</li>
	<li>в Value записываем логин и пароль для БД в таком виде:</li>
	<li>
	<pre style="margin-left:40px">
---
<strong>db_user: user</strong> #(имя предпочитаемого пользователя, запомните, или запишите его)
<strong>db_pass: some_pass</strong> #(предпочитаемый пароль, запомните, или запишите его)</pre>
	</li>
	<li>сохраняем</li>
</ul>

<p><strong>3) Создать виртуальные машины в облаке с внешними ip в одной сети и занести информацию в файл inventory/hosts.yaml</strong></p>

<p style="margin-left:40px">Добавляем публичный ключ, который получили ранее в пункте (2)&nbsp;<strong>my_key.pub&nbsp;</strong>для создания виртуальных машин</p>

<p style="margin-left:40px">Создаем виртуальные машины в одной локальной сети с выделенными IP, с сетевыми именами:</p>

<ul style="margin-left:40px">
	<li>app01</li>
	<li>app02</li>
	<li>database</li>
	<li>monitoring</li>
	<li>loadbalancer</li>
	<li>backup</li>
</ul>

<p style="margin-left:40px">Наполняем файл inventory/hosts.yml прямо в репозитории</p>

<pre>
<strong>---
all:
    vars:
        ansible_user: ubuntu                              # пользователь выданный облаком
        ansible_ssh_private_key_file: .ssh/id_rsa         # не трогаем
        master: &quot;10.0.0.18&quot;                               # app01 адрес локальной сети
        slave: &quot;10.0.0.8&quot;                                 # app02 адрес локальной сети
        url_site: &quot;89.208.229.252&quot;                        # адрес балансировщика
        db_mysql: &quot;10.0.0.21&quot;                             # database адрес локальной сети
    children:
        webservers:
            hosts:
                app01:
                    ansible_host: 185.86.146.39           # app01 внешний адрес 
                app02:
                    ansible_host: 89.208.228.214          # app02 внешний адрес 
        mysql:
            hosts:
                database:
                    ansible_host: 109.120.181.129         # database внешний адрес
        monitoring:
            hosts:
                monitoring:
                    ansible_host: 185.86.145.208          # monitoring внешний адрес
        load_balancer:
            hosts:
                loadbalancer:
                    ansible_host: 89.208.229.252          # loadbalancer внешний адрес
        backup:
            hosts:
                backup:
                    ansible_host: 5.188.142.17            # backup внешний адрес</strong></pre>

