# Matriz de Candidatos Seguros - Fallback Controlado do Catalogo

Data: 2026-06-30

## Objetivo

Mapear candidatos restantes para consumo controlado de tokens do `theme_eaduems` pelo plugin `local_catalogo_eaduems`, antes de qualquer nova alteracao em `styles.css`.

Esta matriz continua a estrategia da ADR-0010: todo consumo de `--eaduems-*` deve manter fallback local obrigatorio e passar por piloto visual antes de ser considerado aprovado.

## Fallbacks ja aprovados

| Alias local | Token do tema | Fallback local | Status |
| --- | --- | --- | --- |
| `--catalogo-token-accent` | `--eaduems-color-accent` | `--catalogo-eaduems-lime` | aprovado |
| `--catalogo-token-button-text` | `--eaduems-color-text-inverse` | `#fff` | aprovado |

## Criterios de classificacao

| Classificacao | Criterio | Acao permitida |
| --- | --- | --- |
| Seguro | Valor equivalente em light/dark ou sem impacto visual esperado. | Pode virar piloto de fallback controlado. |
| Cauteloso | Equivalencia semantica forte, mas valor computado muda em algum modo. | Exige decisao visual antes de piloto. |
| Adiado | Sem token equivalente, risco alto ou impacto amplo. | Nao implementar agora. |

## Matriz principal

| Alias local | Valor atual/fallback local | Candidato do tema | Valor light do tema | Valor dark do tema | Risco | Recomendacao |
| --- | --- | --- | --- | --- | --- | --- |
| `--catalogo-token-button-radius` | `4px` | `--eaduems-radius-xs` | `4px` | `4px` | baixo | Seguro para proximo piloto. |
| `--catalogo-token-button-font-weight` | `700` | `--eaduems-font-weight-bold` | `700` | `700` | baixo | Seguro para piloto tipografico/estrutura de botao. |
| `--catalogo-token-button-min-height` | `2.5rem` | sem token direto | n/a | n/a | baixo/medio | Adiar ou criar alias local sem fallback global. |
| `--catalogo-token-button-padding` | `.5rem .875rem` | sem token direto | n/a | n/a | medio | Adiar; spacing do catalogo precisa piloto proprio. |
| `--catalogo-token-filter-button-padding` | `.5rem 1rem` | sem token direto | n/a | n/a | medio | Adiar; afeta filtros desktop/mobile. |
| `--catalogo-token-focus-ring` | `rgba(214, 223, 42, .9)` | `--eaduems-color-focus-ring` | `rgba(214, 223, 42, 0.18)` | `rgba(214, 223, 42, 0.24)` | alto | Nao trocar agora; valores de alpha sao muito diferentes. |
| `--catalogo-token-surface` | `#ffffff` | `--eaduems-color-surface` | `#ffffff` | `#18251f` | alto | Adiado; mudaria surface no dark mode. |
| `--catalogo-token-surface-soft` | `#f5f8f3` | `--eaduems-color-surface-soft` | `#f4f8f5` | `#16211c` | alto | Adiado; equivalencia semantica existe, mas dark muda muito. |
| `--catalogo-token-border` | `#d8e0dc` | `--eaduems-color-border` | `rgba(15, 111, 60, 0.14)` | `rgba(255, 255, 255, 0.1)` | alto | Adiado; bordas mudariam em light/dark. |
| `--catalogo-token-card-surface` | `var(--catalogo-token-surface)` | `--eaduems-card-bg` ou `--eaduems-card-surface-bg` | `#ffffff` | `#18251f` | alto | Adiado junto com surface. |
| `--catalogo-token-card-border` | `var(--catalogo-token-border)` | `--eaduems-card-surface-border` | `rgba(15, 111, 60, 0.14)` | `rgba(255, 255, 255, 0.1)` | alto | Adiado junto com border. |
| `--catalogo-token-filter-border` | `var(--catalogo-token-border)` | `--eaduems-color-border` | `rgba(15, 111, 60, 0.14)` | `rgba(255, 255, 255, 0.1)` | alto | Adiado junto com border. |
| `--catalogo-token-clearfilter-surface` | `#fff` | `--eaduems-color-surface` | `#ffffff` | `#18251f` | alto | Adiado; mudaria limpar filtro no dark mode. |
| `--catalogo-token-empty-surface` | `#f6faf8` | `--eaduems-color-surface-soft` | `#f4f8f5` | `#16211c` | alto | Adiado; estado vazio tem contrato proprio neutral. |
| `--catalogo-token-button-bg` | `#0f6b3a` | `--eaduems-color-primary` | `#0f6f3c` | `#38a169` | medio/alto | Cauteloso; sem zero-visual-change, especialmente em dark. |
| `--catalogo-token-button-bg-hover` | `#064625` | `--eaduems-color-primary-2` | `#0b4f2b` | `#2f855a` | medio/alto | Cauteloso; exige decisao visual. |
| `--catalogo-token-button-border` | `#0f6b3a` | `--eaduems-color-primary` | `#0f6f3c` | `#38a169` | medio/alto | Cauteloso; migrar junto com button bg, nao isolado. |
| `--catalogo-token-button-border-hover` | `#064625` | `--eaduems-color-primary-2` | `#0b4f2b` | `#2f855a` | medio/alto | Cauteloso; migrar junto com hover bg, nao isolado. |
| `--catalogo-token-filter-button-bg` | `#064625` | `--eaduems-color-primary-2` | `#0b4f2b` | `#2f855a` | medio/alto | Cauteloso; depende da decisao dos botoes/filtros. |
| `--catalogo-token-filter-button-bg-hover` | `#0f6b3a` | `--eaduems-color-primary` | `#0f6f3c` | `#38a169` | medio/alto | Cauteloso; depende da decisao dos botoes/filtros. |

## Candidatos seguros para proximo piloto

| Prioridade | Alias local | Proposta de fallback | Motivo |
| --- | --- | --- | --- |
| 1 | `--catalogo-token-button-radius` | `var(--eaduems-radius-xs, 4px)` | Valor identico, baixo impacto e alinhado aos tokens de radius ja consolidados. |
| 2 | `--catalogo-token-button-font-weight` | `var(--eaduems-font-weight-bold, 700)` | Valor identico, baixo risco visual e alinhado aos aliases tipograficos. |

## Candidatos que precisam de decisao antes de piloto

| Familia | Motivo |
| --- | --- |
| Botoes verdes | Tokens do tema sao semanticamente corretos, mas os valores divergem do catalogo e mudam no dark mode. |
| Surfaces e bordas | A troca aplicaria dark mode real em partes do catalogo, o que e desejavel no objetivo final, mas nao deve acontecer como fallback silencioso. |
| Focus ring | O alpha atual e muito mais forte que o token global; migrar agora pode reduzir percepcao de foco. |
| Spacing dos botoes/filtros | Nao ha token global equivalente exato para `.875rem`; precisa piloto de spacing proprio. |

## Decisao

A proxima alteracao tecnica recomendada, se continuarmos na frente de fallback do catalogo, e um piloto de baixo risco em `--catalogo-token-button-radius`.

Como segunda opcao segura, `--catalogo-token-button-font-weight` pode ser migrado depois do radius ou junto em uma frente pequena, desde que a validacao capture botoes do catalogo e filtros em desktop/mobile/light/dark.

## Guardrails

1. Nao aplicar fallback em surface, border ou focus-ring nesta rodada.
2. Nao migrar botoes verdes sem decisao visual explicita sobre dark mode do catalogo.
3. Nao remover variaveis `--catalogo-eaduems-*`; elas continuam sendo fallback local e contrato de compatibilidade.
4. Todo piloto deve gerar documento proprio e capturas via Playwright.
