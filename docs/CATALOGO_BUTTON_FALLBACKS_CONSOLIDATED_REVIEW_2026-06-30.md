# Revisao Consolidada - Fallbacks Seguros de Botoes do Catalogo

Data: 2026-06-30

## Objetivo

Consolidar os fallbacks seguros ja aprovados visualmente para botoes do plugin `local_catalogo_eaduems`, antes de decidir se a frente de fallback continua ou pausa.

## Fallbacks de botoes aprovados

| Alias local | Fallback aplicado | Valor preservado | Status |
| --- | --- | --- | --- |
| `--catalogo-token-button-text` | `var(--eaduems-color-text-inverse, #fff)` | `#ffffff` | aprovado tecnicamente e visualmente |
| `--catalogo-token-button-radius` | `var(--eaduems-radius-xs, 4px)` | `4px` no alias | aprovado tecnicamente e visualmente |
| `--catalogo-token-button-font-weight` | `var(--eaduems-font-weight-bold, 700)` | `700` | aprovado tecnicamente e visualmente |

## Observacao sobre radius

O fallback de `--catalogo-token-button-radius` preserva o alias em `4px`, mas os botoes principais e o botao de filtro continuam computando `border-radius: 0px` porque existe uma regra posterior de padronizacao retangular com `!important`.

Isso significa que o fallback e seguro, mas a decisao visual sobre botoes arredondados ou retangulares continua fora desta consolidacao.

## Evidencias

| Frente | Documento do plugin | Evidencias no tema |
| --- | --- | --- |
| Button text | `docs/CATALOGO_TOKEN_BUTTON_TEXT_FALLBACK_PILOT_2026-06-30.md` | `docs/assets/catalog-button-text-fallback-pilot-2026-06-30` |
| Button radius | `docs/CATALOGO_TOKEN_BUTTON_RADIUS_FALLBACK_PILOT_2026-06-30.md` | `docs/assets/catalog-button-radius-fallback-pilot-2026-06-30` |
| Button font-weight | `docs/CATALOGO_TOKEN_BUTTON_FONT_WEIGHT_FALLBACK_PILOT_2026-06-30.md` | `docs/assets/catalog-button-font-weight-fallback-pilot-2026-06-30` |

## Guardrails mantidos

1. Fallback local continua obrigatorio em todo consumo de `--eaduems-*`.
2. Nenhum seletor consumidor foi reescrito nesta subfrente.
3. Nenhuma classe `catalogo-eaduems-*` foi renomeada.
4. `surface`, `border`, `focus-ring` e botoes verdes continuam adiados.
5. Dark mode global continua objetivo final, mas nao sera ativado por troca pontual de tokens de botoes.

## Decisao

A subfrente de fallbacks seguros de botoes fica consolidada como aprovada para `text`, `radius` e `font-weight`.

Nao ha outro candidato de botao com equivalencia exata e baixo risco neste momento. Os proximos candidatos relacionados a botoes entram em outra categoria:

| Familia | Motivo para nao seguir automaticamente |
| --- | --- |
| `button-bg` / `button-border` | Valores do tema divergem do verde atual e mudam em dark mode. |
| `button-padding` / `filter-button-padding` | Nao ha token global equivalente exato para `.875rem`. |
| `focus-ring` | Alpha do token global difere muito do foco atual do catalogo. |

## Proxima frente recomendada

Pausar a frente de fallback de botoes e decidir entre:

1. criar uma matriz especifica de spacing dos botoes/filtros;
2. iniciar uma frente visual sobre botoes retangulares versus radius real;
3. voltar para outra familia do design system antes de tocar em surface/border/dark mode do catalogo.
