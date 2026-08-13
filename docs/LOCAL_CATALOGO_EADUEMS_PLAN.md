# local_catalogo_eaduems - plano t�cnico inicial

Este documento planeja um novo plugin de cat�logo de cursos para Moodle 5.1, usando como base t�cnica o aprendizado do `local_catalogo` v1.1, mas com identidade visual e fluxo inspirados no tema Lambda informado como refer�ncia.

## 1. Identidade do novo projeto

- Nome t�cnico do plugin: `local_catalogo_eaduems`.
- Componente Moodle: `local_catalogo_eaduems`.
- Tipo: plugin `local`.
- Caminho confirmado do plugin no Moodle: `local/catalogo_eaduems`.
- Diret�rio local confirmado: `D:\wamp64\www\moodle\public\local\catalogo_eaduems`.
- Reposit�rio local: separado do reposit�rio do `local_catalogo`.
- Reposit�rio GitHub: separado do reposit�rio do `local_catalogo`.
- Nome confirmado do reposit�rio GitHub: `local_catalogo_eaduems`.
- URL remota esperada: `https://github.com/s681109/local_catalogo_eaduems.git`.
- Moodle alvo: 5.1.
- Objetivo: disponibilizar um cat�logo p�blico de cursos com visual pr�ximo �s p�ginas de refer�ncia Lambda, mantendo regras seguras de visibilidade, busca, filtros, detalhes e autentica��o.

## 2. Refer�ncias visuais

### Index

Refer�ncia:

```text
https://lambda-demo-01.redpithemes.com/course/index.php
```

Capturas locais:

```text
docs/eaduems_reference/lambda-index-desktop.png
docs/eaduems_reference/lambda-index-mobile.png
```

Elementos desejados:

- Header superior com identidade do site.
- �rea de login r�pido com inputs de usu�rio e senha quando o visitante n�o estiver autenticado.
- Navega��o/menus pr�ximos ao estilo Lambda.
- T�tulo de p�gina e �rea de listagem de cursos.
- Busca e filtros vis�veis.
- Cards/listagem de cursos com imagem, t�tulo, resumo e chamada para detalhes/acesso.
- Sidebar ou bloco lateral com categorias/filtros, conforme a refer�ncia.
- Layout responsivo desktop/mobile.
- Identidade EAD/UEMS pr�pria, usando a refer�ncia Lambda como inspira��o estrutural.
- Paleta em tons de verde, coerente com os projetos anteriores.

Mapeamento visual observado:

- Faixa superior fina em amarelo.
- Cabe�alho branco com logo � esquerda.
- Login r�pido no topo direito em desktop, contendo campo de usu�rio, campo de senha, bot�o quadrado com seta e link de recupera��o de senha.
- Em mobile, logo centralizado e login r�pido empilhado abaixo do logo.
- Barra de navega��o escura com �cone de in�cio, menus e busca.
- T�tulo de p�gina em uma faixa/badge amarelo.
- Conte�do em container claro, com lista principal de cursos � esquerda e sidebar de categorias/busca � direita no desktop.
- Cards em formato horizontal no desktop: imagem � esquerda, t�tulo/categoria/resumo/CTA � direita.
- Cards empilhados em mobile: imagem acima, textos abaixo, CTA amarelo.
- Sidebar de categorias no desktop com contadores; no mobile ela n�o aparece no primeiro viewport capturado.

### Detalhes

Refer�ncia:

```text
https://lambda-demo-01.redpithemes.com/enrol/index.php?id=13
```

Capturas locais:

```text
docs/eaduems_reference/lambda-details-desktop.png
docs/eaduems_reference/lambda-details-mobile.png
```

Elementos desejados:

- P�gina de apresenta��o/inscri��o do curso com layout inspirado na p�gina de enrolment do Lambda.
- T�tulo do curso em destaque.
- Imagem do curso.
- Resumo/descri��o.
- Metadados do curso.
- A��es adequadas por perfil:
  - visitante: login r�pido e dois bot�es de a��o, um para criar conta e outro para acessar conta existente;
  - autenticado n�o inscrito: acessar fluxo de inscri��o/acesso do Moodle;
  - autenticado inscrito: continuar/acessar curso.

Mapeamento visual observado:

- Em sess�o an�nima, a URL de enrolment renderiza uma tela de login/entrada, n�o uma p�gina p�blica tradicional de detalhes.
- Layout desktop dividido em duas �reas:
  - coluna esquerda branca com logo, formul�rio de login, recupera��o de senha, cria��o de conta, aviso informativo e cookies;
  - �rea direita com imagem grande em tela cheia.
- Formul�rio de login com inputs de usu�rio e senha em estilo linha inferior, �cones � esquerda e bot�o amarelo.
- Link `Lost password?` abaixo do bot�o.
- Bloco de cria��o de conta separado por linha divis�ria.
- Aviso informativo em caixa azul clara.
- No mobile, a �rea da imagem praticamente desaparece do primeiro viewport e a coluna de login ocupa a tela.

Decis�o visual para o novo plugin:

- O layout ser� uma inspira��o visual no Lambda, n�o uma reprodu��o literal.
- A identidade visual ser� pr�pria da EAD/UEMS.
- A paleta deve manter tons de verde dos projetos anteriores como base principal.
- A Index deve seguir a estrutura de cat�logo/listagem da refer�ncia.
- A p�gina Detalhes deve combinar a experi�ncia de curso do `local_catalogo` com o padr�o visual de entrada/inscri��o observado na refer�ncia Lambda.
- O formul�rio completo de login deve ser tratado como componente reutiliz�vel na Index e na p�gina Detalhes.
- O login r�pido deve aparecer na Index e na p�gina Detalhes para visitantes/convidados.
- Assets visuais do tema Lambda n�o devem ser copiados; o plugin deve usar CSS e imagens pr�prias/do Moodle.

## 3. Reaproveitamento da base v1.1

O novo plugin deve reaproveitar conceitos e decis�es j� validadas no `local_catalogo`:

- Listar apenas cursos com `course.visible = 1`.
- Ignorar curso site/frontpage (`course.id > 1`).
- Respeitar categorias vis�veis.
- Bloquear detalhes de cursos ocultos ou em categorias ocultas.
- Busca por `fullname`, `shortname` e `summary`.
- Filtros por categoria, n�vel e certificado.
- Ordena��o por nome, categoria e cursos recentes.
- Pagina��o com preserva��o de filtros.
- Tratamento seguro de campos personalizados de curso.
- Fallback para cursos sem imagem pr�pria.
- Configura��es administrativas para pagina��o, textos e metadados.
- Strings de idioma em `lang/pt_br` e `lang/en`.

## 4. Login r�pido no header

O novo plugin deve ter formul�rio real de login r�pido, n�o apenas links, enquanto a customiza��o institucional de tema ainda n�o existir.

### Dire��o arquitetural definitiva

A solu��o definitiva para o login institucional EAD/UEMS deve ser implementada em n�vel de tema Moodle, n�o dentro do plugin `local_catalogo_eaduems`.

Diretriz confirmada:

- manter o plugin focado no cat�logo de cursos;
- planejar uma customiza��o de tema para a navbar/login institucional EAD/UEMS;
- substituir, no tema, os itens nativos de login por uma �rea com o mesmo padr�o visual planejado para o cat�logo:
  - input de usu�rio;
  - input de senha;
  - bot�o `Acessar`;
  - a��o `Esqueci minha senha`;
  - a��o `Criar conta`;
  - `logintoken`;
  - `wantsurl` para retorno seguro;
- quando essa customiza��o de tema estiver pronta, remover do plugin o bloco pr�prio de login/topbar para evitar duplicidade;
- n�o alterar core Moodle para esse objetivo, salvo se houver decis�o administrativa expl�cita em sentido contr�rio.

Motivo: o plugin `local` renderiza conte�do dentro da �rea principal da p�gina; a navbar superior � responsabilidade do tema. Tentar substituir estruturalmente a navbar pelo plugin com CSS/JS seria fr�gil e dependente do HTML do tema.

### Visitante ou convidado

Exibir no header/topbar da Index e da p�gina Detalhes:

- input de usu�rio;
- input de senha;
- bot�o `Acessar`;
- link para recupera��o de senha;
- link para criar conta, usando o cadastro habilitado no Moodle alvo.

### Usu�rio autenticado

Exibir na Index e na p�gina Detalhes:

- nome ou identifica��o curta do usu�rio;
- link para sair;
- link para �rea de cursos/painel, se fizer sentido no layout.

### Regras t�cnicas

- O plugin n�o deve validar senha manualmente.
- O login deve usar o fluxo seguro do core Moodle.
- O formul�rio deve postar para `/login/index.php` com os campos esperados pelo Moodle:
  - `username`;
  - `password`;
  - `logintoken`;
  - `anchor`, se necess�rio.
- O `logintoken` deve ser gerado/obtido por API compat�vel com Moodle 5.1.
- Quando poss�vel, o usu�rio deve retornar ao cat�logo ou � p�gina de detalhes ap�s autenticar.
- Erros de login devem ser tratados pelo Moodle ou exibidos de forma segura sem expor dados sens�veis.

## 5. Arquitetura proposta

Estrutura inicial prevista:

```text
local/catalogo_eaduems/
??? version.php
??? settings.php
??? styles.css
??? classes/
?   ??? output/
?   ?   ??? renderer.php
?   ??? local/
?       ??? course_repository.php
?       ??? customfield_helper.php
?       ??? config.php
??? public/
?   ??? index.php
?   ??? detalhes.php
??? lang/
?   ??? pt_br/local_catalogo_eaduems.php
?   ??? en/local_catalogo_eaduems.php
??? pix/
```

Diretriz: no novo plugin, evitar que `public/index.php` e `renderer.php` concentrem toda a l�gica. Separar consultas e helpers desde o in�cio.

## 6. Rotas previstas

```text
/local/catalogo_eaduems/public/index.php
/local/catalogo_eaduems/public/detalhes.php?id={courseid}
```

Poss�veis rotas futuras:

```text
/local/catalogo_eaduems/public/category.php?id={categoryid}
```

## 7. Funcionalidades da Index

- Hero/t�tulo conforme refer�ncia.
- Header com login r�pido.
- Busca textual.
- Filtro por categoria.
- Filtros por campos personalizados:
  - `nivel`;
  - `certificado`.
- Ordena��o:
  - nome;
  - categoria;
  - mais recentes.
- Cards em estilo pr�ximo ao Lambda.
- Pagina��o configur�vel.
- Estado vazio.
- Fallback para curso sem imagem.

## 8. Funcionalidades da p�gina Detalhes

- Layout inspirado em `/enrol/index.php?id=13`.
- Conte�do principal do curso:
  - nome;
  - imagem;
  - resumo;
  - conte�do/se��es;
  - campos personalizados ricos quando existirem.
- Bloco de a��o:
  - visitante: login r�pido e dois bot�es de a��o:
    - `Criar conta`, direcionando para `/login/signup.php`;
    - `J� tenho conta`, direcionando para `/login/index.php`;
  - autenticado n�o inscrito: acessar curso/inscri��o pelo Moodle;
  - autenticado inscrito: continuar curso.
- Metadados configur�veis:
  - dura��o;
  - n�vel;
  - p�blico;
  - certificado;
  - professor/tutor.

## 9. Configura��es administrativas previstas

- Cursos por p�gina.
- Textos do hero da Index.
- Exibi��o/oculta��o de metadados.
- Cores/estilo de fallback por categoria.
- Controle de exibi��o do login r�pido:
  - ativado/desativado;
  - exibir link de cadastro;
  - texto do bot�o.
- URLs auxiliares opcionais:
  - recupera��o de senha;
  - cadastro;
  - painel/meus cursos.

## 10. Seguran�a e acessibilidade

- Usar `s()` para textos simples.
- Usar `format_text()` para HTML confi�vel do Moodle.
- Gerar URLs com `moodle_url`.
- N�o autenticar usu�rio manualmente.
- N�o armazenar senha no plugin.
- Garantir `label` em inputs de login.
- Garantir foco vis�vel.
- Garantir mensagens de erro seguras.
- N�o copiar assets propriet�rios do tema Lambda.
- Criar CSS pr�prio inspirado no layout, sem depender do tema Lambda.

## 11. Fases sugeridas

### Fase 1 - Planejamento visual e t�cnico

- [x] Definir nome t�cnico `local_catalogo_eaduems`.
- [x] Registrar refer�ncias Lambda.
- [x] Registrar requisito de login r�pido com inputs.
- [x] Capturar screenshots desktop/mobile das refer�ncias.
- [x] Mapear componentes visuais da Index.
- [x] Mapear componentes visuais da p�gina Detalhes/enrol.

### Fase 2 - Scaffold do novo plugin

- [ ] Criar diret�rio `local/catalogo_eaduems`.
- [ ] Criar `version.php`, `settings.php`, `lang`, `public`, `classes` e `styles.css`.
- [ ] Registrar strings base.
- [ ] Garantir reconhecimento do plugin pelo Moodle.

### Fase 3 - Base de dados e helpers

- [ ] Implementar reposit�rio de cursos.
- [ ] Implementar helper de campos personalizados.
- [ ] Implementar leitura de configura��es.
- [ ] Portar regras de visibilidade da v1.1.

### Fase 4 - Index estilo Lambda

- [ ] Implementar layout inicial da Index.
- [ ] Implementar header com login r�pido.
- [ ] Implementar busca, filtros e ordena��o.
- [ ] Implementar cards.
- [ ] Implementar pagina��o e estado vazio.

### Fase 5 - Detalhes estilo Lambda

- [ ] Implementar p�gina de detalhes.
- [ ] Implementar bloco de a��o por perfil.
- [ ] Implementar metadados configur�veis.
- [ ] Implementar fallback de conte�do.

Ponto de retomada: ap�s a valida��o da Index e a decis�o de tratar o login institucional como customiza��o futura de tema, a pr�xima sess�o do plugin deve iniciar pela p�gina Detalhes estilo Lambda.

### Fase 6 - Valida��o

- [ ] Validar visitante.
- [ ] Validar login r�pido com usu�rio real de teste.
- [ ] Validar autenticado n�o inscrito.
- [ ] Validar autenticado inscrito.
- [ ] Validar desktop/mobile.
- [ ] Validar curso sem imagem.
- [ ] Validar curso com campos vazios e campos longos.

## 12. Decis�es fechadas

- O novo plugin ficar� em reposit�rio separado tanto localmente quanto no GitHub.
- O caminho local confirmado ser� `D:\wamp64\www\moodle\public\local\catalogo_eaduems`.
- O reposit�rio remoto esperado ser� `https://github.com/s681109/local_catalogo_eaduems.git`.
- O layout ser� inspira��o visual no Lambda, com identidade EAD/UEMS pr�pria e tons de verde dos projetos anteriores.
- O login r�pido aparecer� na Index e na p�gina Detalhes.
- O plugin manter� compartilhamento via WhatsApp.
- O cadastro de conta estar� habilitado no Moodle alvo.
- A p�gina Detalhes exibir�, para visitantes, dois bot�es de a��o principais: criar conta em `/login/signup.php` e acessar conta existente em `/login/index.php`.
- O login institucional definitivo ser� planejado em n�vel de tema Moodle. O bloco de login do plugin ser� tratado como solu��o provis�ria e dever� ser removido quando a navbar/login do tema EAD/UEMS estiver pronta.

## 13. Decis�es em aberto

- Nenhuma decis�o funcional aberta neste momento.

## Fechamento de release - 2026-05-27

Decis�o:

- O plugin `local_catalogo_eaduems` foi considerado candidato a entrega funcional.
- Ser�o gerados dois artefatos de distribui��o:
  - `0.3.0-beta` com `MATURITY_BETA`, para valida��o intermedi�ria.
  - `1.0.0` com `MATURITY_STABLE`, como entrega inicial est�vel.
- A vers�o mantida no reposit�rio principal passa a ser `1.0.0 / MATURITY_STABLE`.

Checklist de release:

- [x] Ajustar metadados de vers�o no `version.php`.
- [ ] Gerar pacote beta.
- [ ] Gerar pacote stable.
- [ ] Validar instala��o no `moodle-teste.local`.
- [ ] Criar commit/tag e enviar ao GitHub.