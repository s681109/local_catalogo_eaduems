# local_catalogo_eaduems - plano técnico inicial

Este documento planeja um novo plugin de catálogo de cursos para Moodle 5.1, usando como base técnica o aprendizado do `local_catalogo` v1.1, mas com identidade visual e fluxo inspirados no tema Lambda informado como referência.

## 1. Identidade do novo projeto

- Nome técnico do plugin: `local_catalogo_eaduems`.
- Componente Moodle: `local_catalogo_eaduems`.
- Tipo: plugin `local`.
- Caminho confirmado do plugin no Moodle: `local/catalogo_eaduems`.
- Diretório local confirmado: `D:\wamp64\www\moodle\public\local\catalogo_eaduems`.
- Repositório local: separado do repositório do `local_catalogo`.
- Repositório GitHub: separado do repositório do `local_catalogo`.
- Nome confirmado do repositório GitHub: `local_catalogo_eaduems`.
- URL remota esperada: `https://github.com/s681109/local_catalogo_eaduems.git`.
- Moodle alvo: 5.1.
- Objetivo: disponibilizar um catálogo público de cursos com visual próximo às páginas de referência Lambda, mantendo regras seguras de visibilidade, busca, filtros, detalhes e autenticação.

## 2. Referências visuais

### Index

Referência:

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
- Área de login rápido com inputs de usuário e senha quando o visitante não estiver autenticado.
- Navegação/menus próximos ao estilo Lambda.
- Título de página e área de listagem de cursos.
- Busca e filtros visíveis.
- Cards/listagem de cursos com imagem, título, resumo e chamada para detalhes/acesso.
- Sidebar ou bloco lateral com categorias/filtros, conforme a referência.
- Layout responsivo desktop/mobile.
- Identidade EAD/UEMS própria, usando a referência Lambda como inspiração estrutural.
- Paleta em tons de verde, coerente com os projetos anteriores.

Mapeamento visual observado:

- Faixa superior fina em amarelo.
- Cabeçalho branco com logo à esquerda.
- Login rápido no topo direito em desktop, contendo campo de usuário, campo de senha, botão quadrado com seta e link de recuperação de senha.
- Em mobile, logo centralizado e login rápido empilhado abaixo do logo.
- Barra de navegação escura com ícone de início, menus e busca.
- Título de página em uma faixa/badge amarelo.
- Conteúdo em container claro, com lista principal de cursos à esquerda e sidebar de categorias/busca à direita no desktop.
- Cards em formato horizontal no desktop: imagem à esquerda, título/categoria/resumo/CTA à direita.
- Cards empilhados em mobile: imagem acima, textos abaixo, CTA amarelo.
- Sidebar de categorias no desktop com contadores; no mobile ela não aparece no primeiro viewport capturado.

### Detalhes

Referência:

```text
https://lambda-demo-01.redpithemes.com/enrol/index.php?id=13
```

Capturas locais:

```text
docs/eaduems_reference/lambda-details-desktop.png
docs/eaduems_reference/lambda-details-mobile.png
```

Elementos desejados:

- Página de apresentação/inscrição do curso com layout inspirado na página de enrolment do Lambda.
- Título do curso em destaque.
- Imagem do curso.
- Resumo/descrição.
- Metadados do curso.
- Ações adequadas por perfil:
  - visitante: login rápido e dois botões de ação, um para criar conta e outro para acessar conta existente;
  - autenticado não inscrito: acessar fluxo de inscrição/acesso do Moodle;
  - autenticado inscrito: continuar/acessar curso.

Mapeamento visual observado:

- Em sessão anônima, a URL de enrolment renderiza uma tela de login/entrada, não uma página pública tradicional de detalhes.
- Layout desktop dividido em duas áreas:
  - coluna esquerda branca com logo, formulário de login, recuperação de senha, criação de conta, aviso informativo e cookies;
  - área direita com imagem grande em tela cheia.
- Formulário de login com inputs de usuário e senha em estilo linha inferior, ícones à esquerda e botão amarelo.
- Link `Lost password?` abaixo do botão.
- Bloco de criação de conta separado por linha divisória.
- Aviso informativo em caixa azul clara.
- No mobile, a área da imagem praticamente desaparece do primeiro viewport e a coluna de login ocupa a tela.

Decisão visual para o novo plugin:

- O layout será uma inspiração visual no Lambda, não uma reprodução literal.
- A identidade visual será própria da EAD/UEMS.
- A paleta deve manter tons de verde dos projetos anteriores como base principal.
- A Index deve seguir a estrutura de catálogo/listagem da referência.
- A página Detalhes deve combinar a experiência de curso do `local_catalogo` com o padrão visual de entrada/inscrição observado na referência Lambda.
- O formulário completo de login deve ser tratado como componente reutilizável na Index e na página Detalhes.
- O login rápido deve aparecer na Index e na página Detalhes para visitantes/convidados.
- Assets visuais do tema Lambda não devem ser copiados; o plugin deve usar CSS e imagens próprias/do Moodle.

## 3. Reaproveitamento da base v1.1

O novo plugin deve reaproveitar conceitos e decisões já validadas no `local_catalogo`:

- Listar apenas cursos com `course.visible = 1`.
- Ignorar curso site/frontpage (`course.id > 1`).
- Respeitar categorias visíveis.
- Bloquear detalhes de cursos ocultos ou em categorias ocultas.
- Busca por `fullname`, `shortname` e `summary`.
- Filtros por categoria, nível e certificado.
- Ordenação por nome, categoria e cursos recentes.
- Paginação com preservação de filtros.
- Tratamento seguro de campos personalizados de curso.
- Fallback para cursos sem imagem própria.
- Configurações administrativas para paginação, textos e metadados.
- Strings de idioma em `lang/pt_br` e `lang/en`.

## 4. Login rápido no header

O novo plugin deve ter formulário real de login rápido, não apenas links, enquanto a customização institucional de tema ainda não existir.

### Direção arquitetural definitiva

A solução definitiva para o login institucional EAD/UEMS deve ser implementada em nível de tema Moodle, não dentro do plugin `local_catalogo_eaduems`.

Diretriz confirmada:

- manter o plugin focado no catálogo de cursos;
- planejar uma customização de tema para a navbar/login institucional EAD/UEMS;
- substituir, no tema, os itens nativos de login por uma área com o mesmo padrão visual planejado para o catálogo:
  - input de usuário;
  - input de senha;
  - botão `Acessar`;
  - ação `Esqueci minha senha`;
  - ação `Criar conta`;
  - `logintoken`;
  - `wantsurl` para retorno seguro;
- quando essa customização de tema estiver pronta, remover do plugin o bloco próprio de login/topbar para evitar duplicidade;
- não alterar core Moodle para esse objetivo, salvo se houver decisão administrativa explícita em sentido contrário.

Motivo: o plugin `local` renderiza conteúdo dentro da área principal da página; a navbar superior é responsabilidade do tema. Tentar substituir estruturalmente a navbar pelo plugin com CSS/JS seria frágil e dependente do HTML do tema.

### Visitante ou convidado

Exibir no header/topbar da Index e da página Detalhes:

- input de usuário;
- input de senha;
- botão `Acessar`;
- link para recuperação de senha;
- link para criar conta, usando o cadastro habilitado no Moodle alvo.

### Usuário autenticado

Exibir na Index e na página Detalhes:

- nome ou identificação curta do usuário;
- link para sair;
- link para área de cursos/painel, se fizer sentido no layout.

### Regras técnicas

- O plugin não deve validar senha manualmente.
- O login deve usar o fluxo seguro do core Moodle.
- O formulário deve postar para `/login/index.php` com os campos esperados pelo Moodle:
  - `username`;
  - `password`;
  - `logintoken`;
  - `anchor`, se necessário.
- O `logintoken` deve ser gerado/obtido por API compatível com Moodle 5.1.
- Quando possível, o usuário deve retornar ao catálogo ou à página de detalhes após autenticar.
- Erros de login devem ser tratados pelo Moodle ou exibidos de forma segura sem expor dados sensíveis.

## 5. Arquitetura proposta

Estrutura inicial prevista:

```text
local/catalogo_eaduems/
├── version.php
├── settings.php
├── styles.css
├── classes/
│   ├── output/
│   │   └── renderer.php
│   └── local/
│       ├── course_repository.php
│       ├── customfield_helper.php
│       └── config.php
├── public/
│   ├── index.php
│   └── detalhes.php
├── lang/
│   ├── pt_br/local_catalogo_eaduems.php
│   └── en/local_catalogo_eaduems.php
└── pix/
```

Diretriz: no novo plugin, evitar que `public/index.php` e `renderer.php` concentrem toda a lógica. Separar consultas e helpers desde o início.

## 6. Rotas previstas

```text
/local/catalogo_eaduems/public/index.php
/local/catalogo_eaduems/public/detalhes.php?id={courseid}
```

Possíveis rotas futuras:

```text
/local/catalogo_eaduems/public/category.php?id={categoryid}
```

## 7. Funcionalidades da Index

- Hero/título conforme referência.
- Header com login rápido.
- Busca textual.
- Filtro por categoria.
- Filtros por campos personalizados:
  - `nivel`;
  - `certificado`.
- Ordenação:
  - nome;
  - categoria;
  - mais recentes.
- Cards em estilo próximo ao Lambda.
- Paginação configurável.
- Estado vazio.
- Fallback para curso sem imagem.

## 8. Funcionalidades da página Detalhes

- Layout inspirado em `/enrol/index.php?id=13`.
- Conteúdo principal do curso:
  - nome;
  - imagem;
  - resumo;
  - conteúdo/seções;
  - campos personalizados ricos quando existirem.
- Bloco de ação:
  - visitante: login rápido e dois botões de ação:
    - `Criar conta`, direcionando para `/login/signup.php`;
    - `Já tenho conta`, direcionando para `/login/index.php`;
  - autenticado não inscrito: acessar curso/inscrição pelo Moodle;
  - autenticado inscrito: continuar curso.
- Metadados configuráveis:
  - duração;
  - nível;
  - público;
  - certificado;
  - professor/tutor.

## 9. Configurações administrativas previstas

- Cursos por página.
- Textos do hero da Index.
- Exibição/ocultação de metadados.
- Cores/estilo de fallback por categoria.
- Controle de exibição do login rápido:
  - ativado/desativado;
  - exibir link de cadastro;
  - texto do botão.
- URLs auxiliares opcionais:
  - recuperação de senha;
  - cadastro;
  - painel/meus cursos.

## 10. Segurança e acessibilidade

- Usar `s()` para textos simples.
- Usar `format_text()` para HTML confiável do Moodle.
- Gerar URLs com `moodle_url`.
- Não autenticar usuário manualmente.
- Não armazenar senha no plugin.
- Garantir `label` em inputs de login.
- Garantir foco visível.
- Garantir mensagens de erro seguras.
- Não copiar assets proprietários do tema Lambda.
- Criar CSS próprio inspirado no layout, sem depender do tema Lambda.

## 11. Fases sugeridas

### Fase 1 - Planejamento visual e técnico

- [x] Definir nome técnico `local_catalogo_eaduems`.
- [x] Registrar referências Lambda.
- [x] Registrar requisito de login rápido com inputs.
- [x] Capturar screenshots desktop/mobile das referências.
- [x] Mapear componentes visuais da Index.
- [x] Mapear componentes visuais da página Detalhes/enrol.

### Fase 2 - Scaffold do novo plugin

- [ ] Criar diretório `local/catalogo_eaduems`.
- [ ] Criar `version.php`, `settings.php`, `lang`, `public`, `classes` e `styles.css`.
- [ ] Registrar strings base.
- [ ] Garantir reconhecimento do plugin pelo Moodle.

### Fase 3 - Base de dados e helpers

- [ ] Implementar repositório de cursos.
- [ ] Implementar helper de campos personalizados.
- [ ] Implementar leitura de configurações.
- [ ] Portar regras de visibilidade da v1.1.

### Fase 4 - Index estilo Lambda

- [ ] Implementar layout inicial da Index.
- [ ] Implementar header com login rápido.
- [ ] Implementar busca, filtros e ordenação.
- [ ] Implementar cards.
- [ ] Implementar paginação e estado vazio.

### Fase 5 - Detalhes estilo Lambda

- [ ] Implementar página de detalhes.
- [ ] Implementar bloco de ação por perfil.
- [ ] Implementar metadados configuráveis.
- [ ] Implementar fallback de conteúdo.

Ponto de retomada: após a validação da Index e a decisão de tratar o login institucional como customização futura de tema, a próxima sessão do plugin deve iniciar pela página Detalhes estilo Lambda.

### Fase 6 - Validação

- [ ] Validar visitante.
- [ ] Validar login rápido com usuário real de teste.
- [ ] Validar autenticado não inscrito.
- [ ] Validar autenticado inscrito.
- [ ] Validar desktop/mobile.
- [ ] Validar curso sem imagem.
- [ ] Validar curso com campos vazios e campos longos.

## 12. Decisões fechadas

- O novo plugin ficará em repositório separado tanto localmente quanto no GitHub.
- O caminho local confirmado será `D:\wamp64\www\moodle\public\local\catalogo_eaduems`.
- O repositório remoto esperado será `https://github.com/s681109/local_catalogo_eaduems.git`.
- O layout será inspiração visual no Lambda, com identidade EAD/UEMS própria e tons de verde dos projetos anteriores.
- O login rápido aparecerá na Index e na página Detalhes.
- O plugin manterá compartilhamento via WhatsApp.
- O cadastro de conta estará habilitado no Moodle alvo.
- A página Detalhes exibirá, para visitantes, dois botões de ação principais: criar conta em `/login/signup.php` e acessar conta existente em `/login/index.php`.
- O login institucional definitivo será planejado em nível de tema Moodle. O bloco de login do plugin será tratado como solução provisória e deverá ser removido quando a navbar/login do tema EAD/UEMS estiver pronta.

## 13. Decisões em aberto

- Nenhuma decisão funcional aberta neste momento.
