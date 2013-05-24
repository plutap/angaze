
class { 'apt':
    always_apt_update => true,
}

Exec['apt_update'] -> Package <| |>

class { 'apache': }

class {'apache::mod::php': }

apache::vhost { 'aplikacja.lh':
    priority      => '10',
    port          => '80',
    docroot       => '/vagrant/web/',
    logroot       => '/vagrant/logs/',
}


class { 'git': }

class { 'php-dev': }
class { 'php-cli': }

class { 'composer':
  auto_update => true
}




class php-cs-fixer {

  exec { 'get-php-cs-fixer':
    command => "wget -O /usr/local/bin/php-cs-fixer http://cs.sensiolabs.org/get/php-cs-fixer.phar",
    path    => '/usr/bin:/bin:/usr/sbin:/sbin'
  }

  exec { 'chmod-php-cs-fixer':
    command => "chmod a+x /usr/local/bin/php-cs-fixer",
    path    => '/usr/bin:/bin:/usr/sbin:/sbin'
  }

#  exec { 'self-update-php-cs-fixer':
#    command => "/usr/local/bin/php-cs-fixer self-update",
#    path    => '/usr/bin:/bin:/usr/sbin:/sbin'
#  }

}

include php-cs-fixer

