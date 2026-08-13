# Revisao Consolidada - Fallbacks Controlados do Catalogo

Data: 2026-06-30

## Objetivo

Consolidar os fallbacks controlados ja aprovados visualmente entre `local_catalogo_eaduems` e `theme_eaduems`, antes de ampliar o consumo de tokens globais pelo plugin.

## Fallbacks aprovados

| Alias local | Fallback aplicado | Valor preservado | Status |
| --- | --- | --- | --- |
| `--catalogo-token-accent` | `var(--eaduems-color-accent, var(--catalogo-eaduems-lime))` | `#d6df2a` | aprovado tecnicamente e visualmente |
| `--catalogo-token-button-text` | `var(--eaduems-color-text-inverse, #fff)` | `#ffffff` | aprovado tecnicamente e visualmente |

## Evidencias

| Frente | Documento do plugin | Evidencias no tema |
| --- | --- | --- |
| Accent fallback | `docs/CATALOGO_TOKEN_ACCENT_FALLBACK_PILOT_2026-06-30.md` | `docs/assets/catalog-accent-fallback-pilot-2026-06-30` |
| Button text fallback | `docs/CATALOGO_TOKEN_BUTTON_TEXT_FALLBACK_PILOT_2026-06-30.md` | `docs/assets/catalog-button-text-fallback-pilot-2026-06-30` |

## Guardrails mantidos

1. Fallback local continua obrigatorio em todo consumo de `--eaduems-*`.
2. Nenhum seletor consumidor foi reescrito durante os pilotos.
3. Nenhuma classe `catalogo-eaduems-*` foi renomeada.
4. Header/portal do plugin continua fora desta frente.
5. Dark mode global continua objetivo final, mas nao sera forcado por troca pontual de token local.

## Candidatos adiados

| Alias local | Motivo do adiamento | Risco |
| --- | --- | --- |
| `--catalogo-token-surface` | `--eaduems-color-surface` muda de valor no dark mode, enquanto a surface atual do catalogo permanece clara. | mudanca visual perceptivel |
| `--catalogo-token-border` | `--eaduems-color-border` usa valores rgba do tema diferentes de `#d8e0dc`. | mudanca visual perceptivel |
| `--catalogo-token-focus-ring` | O foco local usa acento com alpha proprio; o token global ainda precisa de equivalencia validada. | mudanca de foco/interacao |

## Decisao

A fase de fallbacks controlados v1 fica consolidada com dois aliases aprovados: `accent` e `button-text`.

Nao devemos ampliar fallbacks por tentativa em candidatos visualmente sensiveis. A proxima ampliacao deve partir de uma matriz explicita `alias local -> candidato do tema -> valor light -> valor dark -> risco -> recomendacao`.

## Proxima frente recomendada

Criar a matriz de candidatos seguros restantes para fallback controlado. Se nenhum candidato tiver equivalencia forte em light/dark, pausar a frente de fallback do catalogo e voltar para outra familia do design system.
