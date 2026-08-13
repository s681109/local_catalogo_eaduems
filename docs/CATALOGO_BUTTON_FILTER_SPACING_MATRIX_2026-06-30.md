# Matriz de Spacing - Botoes e Filtros do Catalogo

Data: 2026-06-30

## Objetivo

Mapear os aliases de spacing dos botoes e filtros do `local_catalogo_eaduems` contra a escala de spacing do `theme_eaduems`, antes de qualquer novo fallback controlado.

Esta matriz continua a consolidacao dos fallbacks seguros de botoes (`text`, `radius`, `font-weight`) e evita que spacing seja migrado por tentativa.

## Escopo

Aliases avaliados:

| Alias local | Valor atual | Uso principal |
| --- | --- | --- |
| `--catalogo-token-button-min-height` | `2.5rem` | Altura minima de botoes principais e filtro. |
| `--catalogo-token-button-padding` | `.5rem .875rem` | Padding de `.catalogo-eaduems-button`. |
| `--catalogo-token-filter-button-padding` | `.5rem 1rem` | Padding do botao de filtro do catalogo. |

Escala global relevante do tema:

| Token do tema | Valor |
| --- | --- |
| `--eaduems-space-xs` | `0.5rem` |
| `--eaduems-space-sm` | `0.75rem` |
| `--eaduems-space-md` | `1rem` |
| `--eaduems-button-min-height` | `3rem` |
| `--eaduems-button-padding-y` | `0.9rem` |
| `--eaduems-button-padding-x` | `1.3rem` |

## Matriz de candidatos

| Alias local | Valor atual | Candidato do tema | Equivalencia | Risco | Recomendacao |
| --- | --- | --- | --- | --- | --- |
| `--catalogo-token-filter-button-padding` | `.5rem 1rem` | `var(--eaduems-space-xs, .5rem) var(--eaduems-space-md, 1rem)` | Exata | baixo | Melhor proximo piloto seguro. |
| `--catalogo-token-button-padding` | `.5rem .875rem` | `var(--eaduems-space-xs, .5rem) .875rem` | Parcial | medio | Adiar; apenas eixo Y possui token exato. |
| `--catalogo-token-button-min-height` | `2.5rem` | `--eaduems-button-min-height` | Divergente (`3rem`) | alto | Adiar; mudaria altura dos botoes. |
| `.catalogo-eaduems-categoryfilter select` padding | `.375rem .625rem` | sem token equivalente | Sem equivalencia | medio | Fora da proxima frente. |
| `.catalogo-eaduems-clearfilter` padding | `.5rem 1rem` em regra posterior | `var(--eaduems-space-xs) var(--eaduems-space-md)` | Potencialmente exata | medio | Mapear em frente propria, pois nao usa alias local ainda. |

## Decisao

O unico candidato seguro imediato e `--catalogo-token-filter-button-padding`, porque os dois eixos possuem equivalencia exata na escala global:

```css
--catalogo-token-filter-button-padding: var(--eaduems-space-xs, .5rem) var(--eaduems-space-md, 1rem);
```

Nao recomendamos migrar `--catalogo-token-button-padding` agora porque o eixo X usa `.875rem`, que nao existe na escala global atual.

Nao recomendamos migrar `--catalogo-token-button-min-height` porque o token global de botao usa `3rem`, diferente dos `2.5rem` atuais do catalogo.

## Guardrails

1. Nao alterar min-height nesta rodada.
2. Nao trocar padding de botoes principais por valor aproximado.
3. Nao migrar selects, limpar filtro ou outros controles sem alias local previo.
4. Validar o piloto recomendado em desktop/mobile/light/dark com capturas e valores computados.

## Proxima frente recomendada

Executar piloto de baixo risco em `--catalogo-token-filter-button-padding`.
