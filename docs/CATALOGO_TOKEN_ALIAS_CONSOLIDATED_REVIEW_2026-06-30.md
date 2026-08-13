# Revisao Consolidada - Aliases Locais do Catalogo

Data: 2026-06-30

## Objetivo

Consolidar os pilotos de aliases locais do plugin `local_catalogo_eaduems` antes de iniciar qualquer consumo de tokens `--eaduems-*` do tema.

Esta revisao nao altera CSS. Ela registra o baseline tecnico atual e define a proxima decisao segura.

## Pilotos consolidados

| Frente | Documento | Status |
| --- | --- | --- |
| Acento/foco e surface/border inicial | Evidencia no tema `CATALOG_TOKEN_ALIAS_PILOT_VALIDATION_2026-06-30.md` | Validado |
| Botoes do catalogo | `docs/CATALOGO_TOKEN_BUTTON_ALIAS_PILOT_2026-06-30.md` | Validado |
| Bordas/surfaces de cards e filtros | `docs/CATALOGO_TOKEN_SURFACE_BORDER_ALIAS_PILOT_2026-06-30.md` | Validado |

## Aliases locais atuais

### Base

```css
--catalogo-token-accent: var(--catalogo-eaduems-lime);
--catalogo-token-focus-ring: rgba(214, 223, 42, .9);
--catalogo-token-surface: var(--catalogo-eaduems-surface);
--catalogo-token-surface-soft: var(--catalogo-eaduems-soft);
--catalogo-token-border: var(--catalogo-eaduems-border);
--catalogo-token-empty-surface: #f6faf8;
```

### Cards, filtros e divisores

```css
--catalogo-token-card-surface: var(--catalogo-token-surface);
--catalogo-token-card-border: var(--catalogo-token-border);
--catalogo-token-filter-border: var(--catalogo-token-border);
--catalogo-token-filter-control-border: var(--catalogo-token-border);
--catalogo-token-filter-divider: var(--catalogo-token-border);
--catalogo-token-category-divider: var(--catalogo-token-border);
--catalogo-token-results-divider: var(--catalogo-token-border);
--catalogo-token-clearfilter-surface: #fff;
--catalogo-token-clearfilter-border: var(--catalogo-token-border);
```

### Botoes

```css
--catalogo-token-button-bg: var(--catalogo-eaduems-green);
--catalogo-token-button-bg-hover: var(--catalogo-eaduems-green-dark);
--catalogo-token-button-border: var(--catalogo-eaduems-green);
--catalogo-token-button-border-hover: var(--catalogo-eaduems-green-dark);
--catalogo-token-button-text: #fff;
--catalogo-token-button-radius: 4px;
--catalogo-token-button-font-weight: 700;
--catalogo-token-button-min-height: 2.5rem;
--catalogo-token-button-padding: .5rem .875rem;
--catalogo-token-filter-button-bg: var(--catalogo-eaduems-green-dark);
--catalogo-token-filter-button-bg-hover: var(--catalogo-eaduems-green);
--catalogo-token-filter-button-padding: .5rem 1rem;
```

## Cobertura atual

| Area | Cobertura | Observacao |
| --- | --- | --- |
| Estado vazio | Parcial | Surface, border e foco ja usam aliases. |
| Hero do catalogo | Parcial | Surface soft e border usam aliases; cores de texto/destaque continuam locais. |
| Botoes | Parcial/boa | Botao principal, filtro e share usam aliases; secundarios ainda podem exigir frente propria. |
| Cards de curso | Parcial/boa | Surface e divisores usam aliases; media/fallback e tipografia continuam fora do escopo. |
| Filtros | Parcial/boa | Bordas, select e clear filter usam aliases; hover/focus do clear filter ainda usa literais rgba por especificidade. |
| Header/portal | Fora da frente | Continua area de alto risco e nao deve entrar em fallback inicial. |

## Decisao consolidada

A primeira fase tecnica da ADR-0010 esta suficientemente coberta para permitir um piloto futuro de fallback controlado.

O piloto de fallback deve obedecer a estes limites:

1. escolher um alias de baixo risco;
2. manter fallback local obrigatorio;
3. alterar apenas a declaracao do alias, nao os seletores consumidores;
4. validar desktop/mobile/light/dark;
5. evitar header/portal, dark mode amplo ou mudancas visuais intencionais.

## Candidato recomendado para primeiro fallback

Alias recomendado:

```css
--catalogo-token-accent: var(--eaduems-color-accent, var(--catalogo-eaduems-lime));
```

Motivo:

1. a equivalencia entre `--catalogo-eaduems-lime` e o acento institucional ja foi mapeada como forte;
2. o fallback preserva o valor atual se o token do tema nao existir;
3. o alias ja e usado como base conceitual para foco/acento;
4. o impacto visual esperado e zero se `--eaduems-color-accent` estiver equivalente ao valor atual.

## Guardrails mantidos

1. Nenhum alias deve consumir `--eaduems-*` sem fallback local.
2. Nenhum seletor deve ser reescrito junto com o primeiro fallback.
3. Nenhum valor visual deve mudar sem aprovacao explicita.
4. Header/portal fica fora da primeira rodada de fallback.
5. Qualquer divergencia visual deve reverter o fallback e manter o alias local atual.

## Proxima frente recomendada

Executar primeiro piloto de fallback controlado em `--catalogo-token-accent`, com fallback local para `--catalogo-eaduems-lime` e validacao visual/automatica da rota do catalogo.
