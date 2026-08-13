# Catalog Theme Independence CTI-02 - Boost

Data: 2026-07-10
Status: aprovado tecnica e visualmente; consolidado
Repositorio principal: `local_catalogo_eaduems`

## Objetivo

Validar o plugin em um tema Moodle alternativo real, usando Boost, sem depender da simulacao empregada no CTI-01.

## Tema e Restauracao

- tema alternativo da captura: `boost`;
- tema original confirmado: `eaduems`;
- a troca ocorre somente durante a execucao automatizada;
- o tema original e restaurado em bloco `finally`, inclusive se a captura falhar;
- os caches Moodle sao purgados apos cada troca.

## Matriz

| Rota | Estados | Viewports | Modos solicitados |
| --- | --- | --- | --- |
| indice | visitante/autenticado | 1366px/390px | light/dark |
| detalhe | visitante/autenticado | 1366px/390px | light/dark |
| vazio | visitante/autenticado | 1366px/390px | light/dark |

Total esperado: 24 cenarios.

## Resultado Tecnico

A matriz foi executada na instancia correta `moodle-teste.local`, alternando temporariamente `eaduems -> boost -> eaduems`.

| Verificacao | Resultado |
| --- | --- |
| Cenarios executados | 24 |
| HTTP `200` | 24 |
| Stylesheet Boost | 24 |
| Stylesheet EADUEMS | 0 |
| Raiz do catalogo presente | 24 |
| Overflow horizontal | 0 |
| Visitante nao autenticado | 12/12 |
| Usuario autenticado | 12/12 |
| Indices com cards | 8/8 |
| Detalhes com action card | 8/8 |
| Estados vazios presentes | 8/8 |
| Tema restaurado | `eaduems` |

As evidencias estao em:

```text
D:\wamp64\www\moodle_teste\public\local\catalogo_eaduems\docs\assets\catalog-theme-independence-cti-02-boost-2026-07-10
```

## Recortes Prioritarios

1. `index-guest-light-desktop-viewport.png`;
2. `index-user-light-desktop-viewport.png`;
3. `index-guest-dark-mobile-viewport.png`;
4. `detail-user-light-mobile-action-card.png`;
5. `empty-guest-light-mobile-empty.png`.

A revisao deve verificar legibilidade, integridade do header fallback, filtros, cards, action card, estado vazio e ausencia de cortes. Diferencas esteticas em relacao ao tema EADUEMS sao aceitaveis.
## Revisao Visual e Conclusao

As capturas foram revisadas e aprovadas pelo usuario em 2026-07-10. O plugin permaneceu funcional com Boost real, sem stylesheet EADUEMS, em todas as rotas e estados da matriz.

Conclusao: o catalogo possui independencia funcional e arquitetural em relacao ao tema EADUEMS. Isso nao implica aparencia identica em todos os temas Moodle; significa que o plugin preserva renderizacao, legibilidade, responsividade e seus componentes essenciais quando o tema institucional nao esta presente.

Proxima frente: `Catalog Semantic Dark Mode v1`.
## Criterios de Aceite

1. Boost e identificado nos estilos carregados pela pagina.
2. Todas as rotas retornam HTTP `200`.
3. A raiz do catalogo permanece presente e utilizavel.
4. Listagem, detalhe e estado vazio continuam renderizando seus componentes essenciais.
5. Nao ocorre overflow horizontal.
6. O cenario `user` permanece autenticado e o cenario `guest` permanece visitante.
7. O tema original e restaurado ao final.
8. A aparencia pode variar em relacao ao tema institucional, mas nao pode ficar quebrada ou ilegivel.

## Dark Mode

Boost pode nao oferecer o mesmo contrato dark do `theme_eaduems`. Os cenarios dark registram o modo solicitado e o comportamento real, mas nao exigem paridade visual com o tema institucional. A paleta dark semantica propria do plugin pertence a frente posterior `Catalog Semantic Dark Mode v1`.

## Script

```text
D:\wamp64\www\moodle_teste\tools\eaduems-visual-tests\scripts\capture-catalog-theme-independence-cti-02-boost.js
```