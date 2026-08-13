# Catalogo Visual Integration v2 Baseline

Data: 2026-07-07
Status: rodada concluida
Repositorio: `local_catalogo_eaduems`

## Objetivo

Registrar no repositorio do plugin a retomada da frente de integracao visual com o tema `theme_eaduems`.

A evidencia principal desta rodada esta no repositorio do tema, pois a frente pertence ao design system compartilhado.

## Evidencia Principal

Documento no tema:

```text
D:\wamp64\www\moodle_teste\public\theme\eaduems\docs\validations\CATALOG_VISUAL_INTEGRATION_V2_BASELINE_VALIDATION_2026-07-07.md
```

Capturas:

```text
D:\wamp64\www\moodle_teste\public\theme\eaduems\docs\assets\catalog-visual-integration-v2-baseline-2026-07-07
```

Script:

```text
D:\wamp64\www\moodle_teste\tools\eaduems-visual-tests\scripts\capture-catalog-visual-integration-v2-baseline.js
```

## Resultado Tecnico Resumido

| Item | Resultado |
| --- | --- |
| Cenarios | 24 |
| Sessoes | visitante e autenticado |
| Modos | light e dark |
| Viewports | desktop e mobile |
| Rotas | index, primeiro detalhe e estado vazio |
| Cards na listagem | 8 em todos os cenarios de index |
| Estado vazio | capturado |
| Detalhe/action card | capturado |
| Overflow horizontal | 0 ocorrencias |

## Decisao

Nao alterar `styles.css`, PHP ou tokens nesta rodada.

A proxima decisao depende da revisao visual das capturas. Se estiverem boas, consolidar e pausar antes de `CVI-01`. Se houver desconforto visual claro, abrir piloto pequeno e especifico.

## Observacao de independencia

A revisao visual desta baseline foi aprovada em 2026-07-07, mas ela cobre a experiencia integrada com `theme_eaduems`.

A independencia do plugin em relacao ao tema ativo foi registrada em:

```text
docs/CATALOGO_THEME_INDEPENDENCE_COMPATIBILITY_V1.md
D:\wamp64\www\moodle_teste\public\theme\eaduems\docs\adr\ADR-0011-catalog-theme-independence.md
```

A CTI-01 foi executada e aprovada visualmente. Proxima frente escolhida: `CVI-01 - Course cards/listing`, preservando independencia do plugin e evitando acoplamento novo com o tema.

## CVI-01 - Baseline de cards/listagem executada

Data: 2026-07-07
Status: aprovado tecnicamente e visualmente

Evidencia principal:

```text
D:\wamp64\www\moodle_teste\public\theme\eaduems\docs\validations\CATALOG_CVI_01_CARD_LISTING_BASELINE_2026-07-07.md
```

Capturas:

```text
D:\wamp64\www\moodle_teste\public\theme\eaduems\docs\assets\catalog-cvi-01-card-listing-baseline-2026-07-07
```

Resumo: 8 cenarios, visitante/autenticado, light/dark, desktop/mobile, 8 cards em todos os cenarios e 0 ocorrencias de overflow horizontal.


## CVI-01 consolidada

Data: 2026-07-07
Status: aprovada tecnicamente e visualmente

Documento de consolidacao:

```text
D:\wamp64\www\moodle_teste\public\theme\eaduems\docs\validations\CATALOG_CVI_01_CARD_LISTING_CONSOLIDATED_REVIEW_2026-07-07.md
```

Decisao seguinte: avancar para `CVI-02 - filtros e limpar filtro`, sem executar ajuste visual em cards neste momento.

## CVI-02 - Baseline de filtros executada

Data: 2026-07-07
Status: aprovado tecnicamente e visualmente

Evidencia principal:

```text
D:\wamp64\www\moodle_teste\public\theme\eaduems\docs\validations\CATALOG_CVI_02_FILTERS_BASELINE_2026-07-07.md
```

Capturas:

```text
D:\wamp64\www\moodle_teste\public\theme\eaduems\docs\assets\catalog-cvi-02-filters-baseline-2026-07-07
```

Resumo: 16 cenarios, filtros e limpar filtro capturados, sidebar desktop e categorias mobile presentes nos viewports esperados, 0 ocorrencias de overflow horizontal.

## CVI-02A - Categoria real ativa executada

Data: 2026-07-07
Status: aprovado tecnicamente e visualmente

Evidencia principal:

```text
D:\wamp64\www\moodle_teste\public\theme\eaduems\docs\validations\CATALOG_CVI_02A_ACTIVE_CATEGORY_BASELINE_2026-07-07.md
```

Capturas:

```text
D:\wamp64\www\moodle_teste\public\theme\eaduems\docs\assets\catalog-cvi-02a-active-category-baseline-2026-07-07
```

Resumo: categoria `Categoria 11` (`category=1`), 8 cenarios, categoria ativa capturada e 0 ocorrencias de overflow horizontal.

## CVI-02A consolidada

Data: 2026-07-07
Status: aprovada tecnicamente e visualmente

Documento de consolidacao:

```text
D:\wamp64\www\moodle_teste\public\theme\eaduems\docs\validations\CATALOG_CVI_02A_ACTIVE_CATEGORY_CONSOLIDATED_REVIEW_2026-07-07.md
```

Decisao seguinte: encerrar filtros sem ajuste visual real e avancar para `CVI-03 - Estado vazio`.

## CVI-03 - Estado vazio executado

Data: 2026-07-07
Status: aprovado tecnicamente e visualmente

Evidencia principal:

```text
D:\wamp64\www\moodle_teste\public\theme\eaduems\docs\validations\CATALOG_CVI_03_EMPTY_STATE_BASELINE_2026-07-07.md
```

Capturas:

```text
D:\wamp64\www\moodle_teste\public\theme\eaduems\docs\assets\catalog-cvi-03-empty-state-baseline-2026-07-07
```

Resumo: 8 cenarios, estado vazio presente, 0 cards, limpar filtro presente e 0 ocorrencias de overflow horizontal.

## CVI-03 consolidada

Data: 2026-07-07
Status: aprovada tecnicamente e visualmente

Documento de consolidacao:

```text
D:\wamp64\www\moodle_teste\public\theme\eaduems\docs\validations\CATALOG_CVI_03_EMPTY_STATE_CONSOLIDATED_REVIEW_2026-07-07.md
```

Decisao seguinte: avancar para `CVI-04 - Detalhe/action card`, sem executar ajuste visual no estado vazio neste momento.

## CVI-04 - Detalhe/action card executado

Data: 2026-07-07
Status: aprovado tecnicamente e visualmente

Evidencia principal:

```text
D:\wamp64\www\moodle_teste\public\theme\eaduems\docs\validations\CATALOG_CVI_04_DETAIL_ACTION_CARD_BASELINE_2026-07-07.md
```

Capturas:

```text
D:\wamp64\www\moodle_teste\public\theme\eaduems\docs\assets\catalog-cvi-04-detail-action-card-baseline-2026-07-07
```

Resumo: 8 cenarios, detalhe/action card/meta/summary presentes, acoes de visitante e autenticado capturadas e 0 ocorrencias de overflow horizontal.
## CVI-04 consolidada

Data: 2026-07-07
Status: aprovada tecnicamente e visualmente

Documento de consolidacao:

```text
D:\wamp64\www\moodle_teste\public\theme\eaduems\docs\validations\CATALOG_CVI_04_DETAIL_ACTION_CARD_CONSOLIDATED_REVIEW_2026-07-07.md
```

Decisao seguinte: fechar `Catalog Visual Integration v2`, sem executar ajuste visual no detalhe/action card neste momento.

## Catalog Visual Integration v2 consolidada

Data: 2026-07-07
Status: concluida

Documento de fechamento:

```text
D:\wamp64\www\moodle_teste\public\theme\eaduems\docs\validations\CATALOG_VISUAL_INTEGRATION_V2_CONSOLIDATED_REVIEW_2026-07-07.md
```

Resumo: CVI-01, CVI-02, CVI-02A, CVI-03 e CVI-04 aprovadas tecnicamente e visualmente. Nenhum ajuste visual real foi necessario. A independencia do plugin em relacao ao tema segue preservada.