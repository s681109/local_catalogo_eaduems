# Catalog Semantic Dark Mode v1

Data: 2026-07-10
Status: CSD-01 e CSD-02c aprovados tecnica e visualmente; frente pausada
Repositorio: `local_catalogo_eaduems`

## Objetivo

Evoluir o catalogo de uma pagina clara inserida em um shell dark para uma experiencia dark semanticamente coerente, preservando sua independencia em relacao ao `theme_eaduems` e ao Boost.

## Premissas

1. O plugin e dono de seus tokens locais e de seus fallbacks.
2. O modo dark e ativado pelo atributo `data-bs-theme="dark"`, mas nao pode exigir que o tema hospedeiro exponha tokens EADUEMS.
3. A mesma semantica deve funcionar em EADUEMS e em Boost; a aparencia pode ter refinamentos progressivos, mas nao dependencias obrigatorias.
4. Mudancas ocorrem por familia semantica, com baseline, piloto, capturas e revisao visual.

## Inventario: Atual -> Alvo

| Semantica | Atual | Alvo v1 | Uso principal | Risco |
| --- | --- | --- | --- | --- |
| `page-surface` | `#ffffff` | surface dark local | raiz do indice | medio |
| `surface` | `#ffffff` | surface dark local | cards, resultados, detalhe | alto |
| `surface-soft` | `#f5f8f3` | surface dark suave | hero, agrupamentos | medio |
| `border` | `#d8e0dc` | borda dark de baixo contraste | filtros, divisores, cards | medio |
| `text` | `#1f2a24` | texto claro legivel | corpo e titulos | alto |
| `text-muted` | `#66756d` | texto secundario claro | resumos e metadados | alto |
| `accent` | lime institucional | manter, validando contraste | estado ativo e foco | medio |
| `control-surface` | branco/literais | surface dark de controle | select e limpar filtro | alto |

Os valores alvo serao definidos como aliases locais no primeiro piloto; esta tabela registra semantica, nao autoriza substituicao automatica por tokens do tema.

## Sequencia

1. `CSD-01`: baseline de superfices, texto e bordas no estado atual.
2. `CSD-02`: piloto de fundacao no indice, migrando page/surface/text/border como conjunto coerente.
3. `CSD-03`: expandir para filtros e controles.
4. `CSD-04`: expandir para detalhe, action card e estado vazio.
5. `CSD-05`: regressao EADUEMS/Boost e consolidacao.

## Fora de Escopo

- Mudar a paleta institucional de botoes verdes nesta frente inicial.
- Alterar o shell global Moodle ou o tema hospedeiro.
- Exigir que Boost exponha o toggle visual de dark mode do EADUEMS.
- Fazer substituicoes globais por seletores Moodle genericos.

## Criterios de Aceite

1. Cada superficie dark tem token local e fallback do plugin.
2. Texto e bordas preservam legibilidade sobre as novas surfaces.
3. Nao ha overflow nem regressao de estrutura.
4. A matriz inclui visitante/autenticado, indice/detalhe/vazio e desktop/mobile.
5. O CTI-02 com Boost e repetido antes da consolidacao final.

## Resultado CSD-01

A baseline executou 24 cenarios cobrindo indice, detalhe e estado vazio; visitante/autenticado; desktop/mobile; light/dark. Todos responderam HTTP `200` e nao houve overflow horizontal.

No indice visitante desktop, os valores computados demonstram que o catalogo ainda esta visualmente claro no modo dark:

| Semantica | Light | Dark |
| --- | --- | --- |
| raiz/page surface | `rgb(255, 255, 255)` | `rgb(255, 255, 255)` |
| card surface | `rgb(255, 255, 255)` | `rgb(255, 255, 255)` |
| texto do card | `rgb(31, 42, 36)` | `rgb(22, 50, 36)` |
| texto muted | `rgb(102, 117, 109)` | `rgb(102, 117, 109)` |
| borda do filtro | `rgb(216, 224, 220)` | `rgb(216, 224, 220)` |

Evidencias:

```text
D:\wamp64\www\moodle_teste\public\local\catalogo_eaduems\docs\assets\catalog-semantic-dark-baseline-csd-01-2026-07-10
```

## Proximo Piloto Recomendado: CSD-02

Aplicar no indice publico, somente sob `data-bs-theme="dark"`, um conjunto de fundacao composto por `page-surface`, `surface`, `surface-soft`, `text`, `text-muted` e `border`. O piloto deve manter a paleta institucional de botoes fora do escopo e validar visitante/autenticado, desktop/mobile e Boost apos a aprovacao visual.
## Resultado CSD-02c

A matriz confirmou texto branco nos 12 cenarios dark:

| Semantica | Valor computado |
| --- | --- |
| Texto raiz | `rgb(255, 255, 255)` |
| Titulo de card | `rgb(255, 255, 255)` |
| Resumo de card | `rgb(255, 255, 255)` |
| Titulo de detalhe | `rgb(255, 255, 255)` |
| Acao primaria | `rgb(255, 255, 255)` |
| Categoria e rotulo | `rgb(255, 255, 255)` |

A rodada completa preservou 24 respostas HTTP `200` e zero overflow horizontal. Aguardando revisao visual final antes da consolidacao no Git.
## Correcao CSD-02c

Diretriz visual aprovada: texto sobre as superficies verdes/dark do catalogo deve usar branco. Os aliases `text`, `text-strong` e `text-muted` passam a resolver para `#ffffff` no dark mode, incluindo resumos, metadados e textos auxiliares.
## Resultado CSD-02b

A rodada de contraste de textos confirmou, nos quatro cenarios dark de indice (visitante/autenticado e desktop/mobile):

| Elemento | Valor computado |
| --- | --- |
| Titulo de resultados | `rgb(255, 255, 255)` |
| Titulo da barra lateral | `rgb(255, 255, 255)` |
| Link de categoria | `rgb(255, 255, 255)` |
| Rotulo de card | `rgb(255, 255, 255)` |

A matriz completa permaneceu com 24 respostas HTTP `200` e zero overflow horizontal. Aguardando revisao visual final do CSD-02b antes da consolidacao no Git.
## Correcao CSD-02b

A revisao visual identificou textos verdes de baixa legibilidade nas superfices dark do indice. Foi introduzido o alias local `--catalogo-token-text-on-brand: #ffffff` para titulos de resultado/categoria, links da lista de categorias, rotulos de cards, chips de contagem e acao de limpar filtro.

A regra usa branco para conteudo de enfase sobre superfices verdes/escuras e mantem `text-muted` para resumos, evitando perder a hierarquia tipografica.
## Resultado CSD-02a

A rodada corretiva confirmou:

| Verificacao | Resultado |
| --- | --- |
| Cenarios | 24 |
| HTTP `200` | 24 |
| Overflow horizontal | 0 |
| Titulos de detalhe claros | 4/4 dark detail |
| Acoes primarias com texto branco | 4/4 dark detail |
| Acoes de compartilhamento com texto branco | 4/4 dark detail |
| Superficies brancas amplas em dark | 0 |

A faixa branca da rota vazia foi eliminada aplicando `page-surface` aos containers Moodle `#topofscroll` e `#region-main`, restritos a indice/detalhes publicos do catalogo em dark mode.

Revisar agora os recortes atualizados de detalhe e estado vazio antes da consolidacao.
## Correcao CSD-02a

A revisao visual identificou contraste insuficiente em titulos e acoes da pagina de detalhes, pois refinamentos locais mais especificos venciam parte das regras semanticas. Tambem foi identificado um footer nativo claro fora da raiz do plugin na rota vazia.

A correcao CSD-02a limita-se a:

1. forcar texto claro em titulos, metadados, acoes primarias, secundarias e compartilhamento no dark mode;
2. substituir o fundo decorativo dos titulos de detalhes/action card pela surface de controle dark;
3. aplicar `page-surface` dark ao `#page-footer` apenas nas rotas publicas do catalogo;
4. medir titulo, acoes e footer nas proximas capturas.

A instrumentacao identificou que a faixa branca da rota vazia vinha de `#topofscroll` e `#region-main`, containers Moodle que envolvem a raiz do plugin. A correcao aplica `page-surface` a esses elementos apenas nas rotas publicas do catalogo em dark mode.
## Resultado CSD-02

A fundacao dark foi executada em 24 cenarios, cobrindo indice, detalhe e estado vazio; visitante/autenticado; desktop/mobile; light/dark.

| Verificacao | Resultado |
| --- | --- |
| HTTP `200` | 24/24 |
| Overflow horizontal | 0 |
| Raiz dark | `rgb(15, 23, 19)` |
| Card dark | `rgb(24, 37, 31)` |
| Titulo de card dark | `rgb(245, 250, 246)` |
| Texto muted dark | `rgb(183, 201, 189)` |
| Borda de filtro dark | `rgb(61, 85, 72)` |
| Visitante preservado | 12/12 |
| Usuario autenticado preservado | 12/12 |

A raiz de detalhes agora recebe `page-surface` dark, eliminando a descontinuidade lateral observada na baseline.

Capturas:

```text
D:\wamp64\www\moodle_teste\public\local\catalogo_eaduems\docs\assets\catalog-semantic-dark-foundation-csd-02-2026-07-10
```

Revisar principalmente os recortes `index-guest-dark-desktop-viewport.png`, `index-guest-dark-desktop-first-card.png`, `index-user-dark-mobile-viewport.png`, `detail-guest-dark-desktop-viewport.png`, `detail-user-dark-mobile-root.png` e `empty-guest-dark-mobile-empty.png`.
## CSD-02: Fundacao de Superficies

Escopo implementado:

1. aliases locais para texto, texto forte, texto muted, surface de controle, borda de controle e surface de contagem;
2. override dark local para `page-surface`, `surface`, `card-surface`, `surface-soft`, `empty-surface`, bordas e controles;
3. cobertura das rotas publicas de indice e detalhes, corrigindo a descontinuidade lateral antes visivel em detalhes;
4. ajustes de texto e controle apenas no conteudo do catalogo; header e botoes institucionais verdes permanecem fora do escopo.

Valores dark candidatos deste piloto:

| Token | Valor |
| --- | --- |
| `page-surface` | `#0f1713` |
| `surface` / `card-surface` | `#18251f` |
| `surface-soft` | `#16211c` |
| `border` | `#3d5548` |
| `text` | `#edf5ef` |
| `text-strong` | `#f5faf6` |
| `text-muted` | `#b7c9bd` |
| `control-surface` | `#1e2d25` |

Aguardando captura e revisao visual antes de consolidacao.
## Baseline CSD-01

```text
D:\wamp64\www\moodle_teste\tools\eaduems-visual-tests\scripts\capture-catalog-semantic-dark-baseline-csd-01.js
```
## Pausa da Sessao

Em 2026-07-10, as capturas finais do `CSD-02c` foram revisadas visualmente e aprovadas. A sessao foi pausada apos a fundacao de dark mode semantico do catalogo.

Ponto de retomada: `CSD-03`, dedicado aos filtros e controles do catalogo no dark mode. A proxima rodada deve preservar as decisoes consolidadas de surfaces, texto branco, bordas e continuidade do shell publico.

## CSD-03: Filtros e Controles

Escopo desta rodada:

1. consolidar aliases semanticos locais para superficie, texto e opcoes do seletor de categoria;
2. garantir texto branco nos controles do catalogo sobre superficies dark;
3. preservar dimensoes, raio e espacamento aprovados anteriormente;
4. validar estados padrao e foco por teclado para seletor, botao Filtrar e acao Limpar;
5. limitar a rodada ao indice publico do catalogo, em visitante/autenticado, desktop/mobile e light/dark.

Nao altera a hierarquia de categorias, o comportamento de filtragem nem a estrutura HTML do plugin.

Criterios de aceite tecnico:

| Verificacao | Resultado esperado |
| --- | --- |
| Resposta HTTP | `200` em todos os cenarios |
| Overflow horizontal | Ausente |
| Dark: seletor, Filtrar e Limpar | Texto branco e superficies controladas |
| Foco por teclado | Anel visivel, sem deslocar layout |
| Light | Valores atuais preservados |

Capturas previstas:

```text
D:\wamp64\www\moodle_teste\public\local\catalogo_eaduems\docs\assets\catalog-semantic-dark-controls-csd-03-2026-07-13
```
### Resultado tecnico CSD-03

A matriz foi executada no indice publico para visitante e usuario autenticado, em desktop/mobile e light/dark.

| Verificacao | Resultado |
| --- | --- |
| Cenarios | 8/8 |
| HTTP `200` | 8/8 |
| Overflow horizontal | 0 |
| Recorte do filtro | 8/8 |
| Foco no seletor | 8/8 |
| Foco em Filtrar | 8/8 |
| Foco em Limpar | 8/8 |
| Texto dos tres controles em dark | `rgb(255, 255, 255)` |

Em dark, o seletor e a acao Limpar usam a surface de controle `rgb(30, 45, 37)` e o botao Filtrar preserva a superficie institucional `rgb(6, 70, 37)`, todos com texto branco. Nenhuma dimensao, raio ou espacamento dos controles foi alterado.

Capturas para revisao visual:

```text
D:\wamp64\www\moodle_teste\public\local\catalogo_eaduems\docs\assets\catalog-semantic-dark-controls-csd-03-2026-07-13
```

Recortes prioritarios:

- `index-guest-dark-desktop-filter.png`
- `index-guest-dark-desktop-select-focus.png`
- `index-guest-dark-desktop-button-focus.png`
- `index-guest-dark-desktop-clear-focus.png`
- `index-guest-dark-mobile-filter.png`
- `index-user-dark-mobile-clear-focus.png`

Aguardando revisao visual antes da consolidacao no Git.
## CSD-04: Detalhe, Action Card e Estado Vazio

A CSD-04 retoma a quarta etapa da sequencia registrada neste documento. Antes de qualquer novo ajuste visual, a baseline localizada deve medir o estado ja entregue pela CSD-02/CSD-03.

Escopo da baseline:

1. detalhe de curso com metadados e action card;
2. estado vazio do catalogo;
3. visitante/autenticado, desktop/mobile e light/dark;
4. foco por teclado nas acoes que estiverem disponiveis no action card;
5. superficies, textos, bordas e overflow.

Nao ha mudanca de CSS nesta subetapa. A implementacao, se necessaria, so sera proposta depois da revisao visual da baseline.

Capturas previstas:

```text
D:\wamp64\www\moodle_teste\public\local\catalogo_eaduems\docs\assets\catalog-semantic-dark-detail-empty-baseline-csd-04-2026-07-13
```
### Resultado tecnico da baseline CSD-04

| Verificacao | Resultado |
| --- | --- |
| Cenarios | 16/16 |
| HTTP `200` | 16/16 |
| Overflow horizontal | 0 |
| Detalhe | 8/8 |
| Estado vazio | 8/8 |
| Foco acao primaria | 8/8 |
| Foco acao secundaria | 8/8 |
| Foco compartilhar | 8/8 |

Nos quatro cenarios dark de detalhe, a action card permaneceu em `rgb(24, 37, 31)` e as tres acoes retornaram texto `rgb(255, 255, 255)`. Nos quatro cenarios dark de estado vazio, a superficie e o texto tambem retornaram respectivamente `rgb(24, 37, 31)` e `rgb(255, 255, 255)`.

Capturas prioritarias para revisao visual:

- `detail-guest-dark-desktop-root.png`
- `detail-guest-dark-desktop-primary-focus.png`
- `detail-guest-dark-desktop-secondary-focus.png`
- `detail-guest-dark-mobile-root.png`
- `empty-guest-dark-desktop-root.png`
- `empty-user-dark-mobile-root.png`

Aguardando revisao visual. Se aprovada sem ressalvas, a CSD-04 sera consolidada como cobertura de validacao, sem introduzir CSS adicional, e a proxima etapa sera a regressao CSD-05 em EADUEMS e Boost.
## CSD-05: Regressao Dark EADUEMS e Boost

Etapa final da sequencia CSD v1. A regressao valida o modo dark ja aprovado sob os dois temas hospedeiros representativos, sem introduzir novos estilos.

Matriz por tema: indice, detalhe e estado vazio; visitante/autenticado; desktop/mobile; sempre em dark mode. Total esperado: 12 cenarios por tema, 24 no total.

Criterios de aceite:

1. resposta HTTP `200` e raiz do catalogo presente;
2. zero overflow horizontal;
3. roots, cards, action card e estado vazio usam superficies dark locais;
4. textos das acoes e do conteudo permanecem brancos;
5. EADUEMS e Boost podem ter shell distinto, mas o catalogo nao pode depender de CSS/tokens do EADUEMS;
6. a instancia deve ser restaurada para `eaduems` ao final.

Evidencias previstas:

```text
D:\wamp64\www\moodle_teste\public\local\catalogo_eaduems\docs\assets\catalog-semantic-dark-regression-csd-05-2026-07-13
```
### Resultado tecnico CSD-05

A regressao dark foi executada com o tema ativo alternado de forma controlada entre `eaduems` e `boost`; a instancia foi restaurada para `eaduems` ao fim da rodada.

| Verificacao | EADUEMS | Boost | Total |
| --- | ---: | ---: | ---: |
| Cenarios | 12/12 | 12/12 | 24/24 |
| HTTP `200` | 12/12 | 12/12 | 24/24 |
| Overflow horizontal | 0 | 0 | 0 |
| Raiz dark `rgb(15, 23, 19)` | 12/12 | 12/12 | 24/24 |
| Acao primaria branca em detalhe | 4/4 | 4/4 | 8/8 |

Sob Boost, os 12 cenarios carregaram `/theme/styles.php/boost/` e nenhum carregou `/theme/styles.php/eaduems/`. O resultado confirma que as superficies dark do catalogo dependem dos tokens e CSS locais do plugin, e nao de folhas, tokens ou templates do tema EADUEMS.

Capturas prioritarias para revisao visual comparativa:

- `eaduems/index-guest-dark-desktop-root.png`
- `boost/index-guest-dark-desktop-root.png`
- `eaduems/detail-guest-dark-desktop-root.png`
- `boost/detail-guest-dark-desktop-root.png`
- `eaduems/empty-guest-dark-mobile-root.png`
- `boost/empty-guest-dark-mobile-root.png`

Diretorio de evidencias:

```text
D:\wamp64\www\moodle_teste\public\local\catalogo_eaduems\docs\assets\catalog-semantic-dark-regression-csd-05-2026-07-13
```

Aguardando revisao visual final antes de encerrar formalmente a frente `Catalog Semantic Dark Mode v1`.
## Encerramento da Frente

Em 2026-07-13, a revisao visual final da CSD-05 foi aprovada. `Catalog Semantic Dark Mode v1` esta encerrada para o escopo definido: superfices, textos, bordas, filtros, controles, detalhe, action card e estado vazio nas rotas publicas do catalogo, com regressao real em EADUEMS e Boost.

O encerramento nao declara dark mode global do Moodle como concluido. Componentes nativos externos ao catalogo permanecem sujeitos a suas frentes proprias de compatibilidade dark.

Proxima decisao de planejamento: retornar ao backlog do design system para selecionar uma familia ainda pendente, preservando o catalogo como plugin independente de tema.