# local_catalogo_eaduems

Novo plugin de catalogo de cursos para Moodle 5.1, com identidade EAD/UEMS.

## Decisoes iniciais

- Componente Moodle: `local_catalogo_eaduems`.
- Caminho Moodle: `local/catalogo_eaduems`.
- Repositorio separado do `local_catalogo`.
- Login rapido na Index e na pagina Detalhes.
- Cadastro de conta habilitado no Moodle alvo.
- Compartilhamento via WhatsApp mantido no escopo do projeto.
- Pagina Detalhes com acoes para `/login/signup.php` e `/login/index.php`.

## Direcao sobre login institucional

O login rapido implementado no plugin e provisório. A solução definitiva deve ser planejada em nivel de tema Moodle, por meio de customizacao da navbar/login institucional EAD/UEMS.

Quando o tema institucional estiver pronto, o plugin deve remover seu bloco proprio de login/topbar e confiar no login oficial do tema, mantendo o plugin focado no catalogo de cursos.

## Proximo ponto de retomada

Retomar o desenvolvimento do plugin pela pagina Detalhes, mantendo a customizacao da navbar/login institucional como trilha futura de tema.

## Documentacao historica recuperada

Para consulta legivel do historico do plugin, priorize estes arquivos:

- `docs/LOCAL_CATALOGO_EADUEMS_PLAN_RECOVERED_2026-06-15.md`
- `docs/LOCAL_CATALOGO_EADUEMS_TODO_RECOVERED_2026-06-15.md`

Os arquivos historicos antigos permanecem no diretorio `docs` apenas como memoria bruta e podem conter corrupcao de codificacao.
