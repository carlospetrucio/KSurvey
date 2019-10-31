# KSurvey

Sistema de pesquisa de satisfação do atendimento de service desk, com integração com aplicações ITSM e dashboard para controles de métricas de atendimento em relação a qualidade.

## Iniciando

Essas instruções fornecerão uma cópia do projeto em execução na sua máquina local para fins de desenvolvimento e teste. Consulte implantação para obter notas sobre como implantar o projeto em um sistema ativo.

### Pré-requisitos

```
PHP 7.1
MySql
Apache
Configuração de assinatura para chamados encerrados no servicenow com hiperlink para validação informando parametros necessários para identificação do usuário e chamado
```

### Instalando

```
Primeiramente o código fonte deverá ser descompactado dentro do servidor apache.
O banco de dados deverá ser importado ao mysql.
```

```
Acessar mysql e configurar em "perfildousuario" admin = 1 e usuario = 2
```

```
Acessar seulink/gerenciamento/register.php e criar uma conta
Acessar mysql e configurar em usuários e mude o seu usuário para 1, após isso remova o arquivo register.php
```

```
Configurar o servicenow para que após o chamado encerrado, enviar hiperlink automatico "seulink/validando-pesquisa.php?PARAMETROS".
Os parametros padrão serão : $chamado, $usuario, $titulo, $datadeencerramento.
```

## Built With

* [BootStrap](https://getbootstrap.com/docs/4.3/) - FrameWork FrontEnd
* [PHP](https://php.net/) - PHP
* [MYSQL](https://dev.mysql.com/doc/) - MySql

## Versionamento

1.0.0 

## Authors

* **Carlos Petrucio** - *Fundador e Desenvolvedor FullStack* - [CarlosPetrucio](https://github.com/CarlosPetrucio)

Veja também a lista de [contributors](https://github.com/carlospetrucio/KSurvey/contributors) que participaram deste projeto.

## Licença

Este projeto não poderá ser utilizado publicamente, apenas com autorização expressa de seu autor.

## Agradecimentos

* Agradecimentos a Glauco Oliveira e Fernanda Ferreira pelo apoio no levantamento de requisitos e documentação.



