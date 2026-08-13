# local_catalogo_eaduems - plano recuperado

Observacao:

- Este documento foi reconstituido em 2026-06-15 a partir do historico disponivel, do README do plugin e dos marcos tecnicos ja consolidados no projeto.
- O arquivo historico original foi preservado no diretorio `docs` apenas como memoria bruta, mesmo contendo corrupcao de codificacao.
- Esta versao passa a ser a referencia legivel e operacional para consulta rapida do plano historico do plugin.

## 1. Identidade do projeto

- Nome tecnico do plugin: `local_catalogo_eaduems`
- Componente Moodle: `local_catalogo_eaduems`
- Tipo: plugin `local`
- Caminho no Moodle: `local/catalogo_eaduems`
- Moodle alvo: 5.1
- Repositorio: separado do projeto `local_catalogo`
- Objetivo: disponibilizar um catalogo publico de cursos com identidade EAD/UEMS, inspirado nas referencias Lambda e integrado ao header institucional compartilhado do tema.

## 2. Escopo funcional historico

- Index publica com listagem de cursos visiveis
- Filtros por categoria
- Pagina de detalhes com metadados, resumo, sessoes e acoes de acesso
- Compartilhamento via WhatsApp
- Placeholders de imagem por iniciais quando o curso nao possui capa
- Painel administrativo para configuracoes do plugin

## 3. Direcao arquitetural consolidada

- O login rapido implementado inicialmente no plugin foi tratado como etapa provisoria.
- A solucao definitiva migrou para o `theme_eaduems_portal`, com header institucional compartilhado.
- O plugin deixou de ser dono do header institucional e passou a focar apenas na experiencia do catalogo.

## 4. Estado consolidado ate 2026-06-15

- `index` e `detalhes` usam o header compartilhado do tema
- quick login e usernav seguem a semantica institucional do tema
- legado morto do header antigo no plugin foi removido
- branding institucional consolidado com `site_logo_url` como chave semantica principal
- `frontpage_footer_logo_url` mantido apenas como alias temporario de compatibilidade no tema

## 5. Referencias de consulta

- README operacional do plugin: `docs/README.md`
- To-do historico recuperado: `docs/LOCAL_CATALOGO_EADUEMS_TODO_RECOVERED_2026-06-15.md`
- Capturas visuais: `docs/visual_checks/`