# local_catalogo_eaduems

Novo plugin de catalogo de cursos para Moodle 5.1, com identidade EAD/UEMS e layout inspirado nas referencias Lambda mapeadas no projeto `local_catalogo`.

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

Retomar o desenvolvimento do plugin pela pagina Detalhes estilo Lambda, mantendo a customizacao da navbar/login institucional como trilha futura de tema.
