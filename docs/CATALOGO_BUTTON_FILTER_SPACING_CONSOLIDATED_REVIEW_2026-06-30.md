# Revisao Consolidada - Spacing Seguro de Botoes e Filtros do Catalogo

Data: 2026-06-30

## Objetivo

Consolidar a frente de spacing seguro dos botoes/filtros do `local_catalogo_eaduems`, apos aprovacao visual do piloto em `--catalogo-token-filter-button-padding`.

## Resultado consolidado

| Alias local | Fallback aplicado | Valor preservado | Status |
| --- | --- | --- | --- |
| `--catalogo-token-filter-button-padding` | `var(--eaduems-space-xs, .5rem) var(--eaduems-space-md, 1rem)` | `0.5rem 1rem` | aprovado tecnicamente e visualmente |

## Evidencias

| Frente | Documento do plugin | Evidencias no tema |
| --- | --- | --- |
| Matriz de spacing | `docs/CATALOGO_BUTTON_FILTER_SPACING_MATRIX_2026-06-30.md` | `docs/validations/CATALOG_BUTTON_FILTER_SPACING_MATRIX_VALIDATION_2026-06-30.md` |
| Piloto de padding do filtro | `docs/CATALOGO_TOKEN_FILTER_BUTTON_PADDING_FALLBACK_PILOT_2026-06-30.md` | `docs/assets/catalog-filter-button-padding-fallback-pilot-2026-06-30` |

## Valores validados

| Valor | Resultado observado |
| --- | --- |
| `--eaduems-space-xs` | `0.5rem` |
| `--eaduems-space-md` | `1rem` |
| `--catalogo-token-filter-button-padding` | `0.5rem 1rem` |
| Padding computado do botao de filtro | `8px 16px 8px 16px` |

## Candidatos adiados

| Alias/controle | Motivo do adiamento |
| --- | --- |
| `--catalogo-token-button-padding` | O eixo X usa `.875rem`, sem equivalencia exata na escala global atual. |
| `--catalogo-token-button-min-height` | O tema possui `--eaduems-button-min-height: 3rem`, diferente dos `2.5rem` do catalogo. |
| `.catalogo-eaduems-categoryfilter select` | Usa padding literal e nao possui alias local especifico. |
| `.catalogo-eaduems-clearfilter` | Possui valor potencialmente equivalente, mas ainda nao passa por alias local controlado. |

## Decisao

A frente de spacing seguro de botoes/filtros fica consolidada com apenas um fallback aprovado: `--catalogo-token-filter-button-padding`.

Nao ha outro candidato de spacing de baixo risco para migracao imediata sem criar novo alias local, expandir a escala de spacing ou aceitar mudanca visual.

## Guardrails mantidos

1. Nao alterar `--catalogo-token-button-padding` por aproximacao.
2. Nao alterar `--catalogo-token-button-min-height` nesta fase.
3. Nao migrar selects ou limpar filtro sem alias local previo.
4. Manter surface, border, focus-ring e botoes verdes fora desta frente.

## Proxima frente recomendada

Pausar a frente de spacing de botoes/filtros e retornar para uma frente de menor acoplamento no design system, ou criar uma frente especifica para novos aliases locais de controles do catalogo antes de qualquer novo fallback.
