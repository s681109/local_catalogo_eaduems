# Piloto - Fallback Controlado do Accent do Catalogo

Data: 2026-06-30

## Objetivo

Executar o primeiro piloto de fallback controlado da ADR-0010, permitindo que um alias local do plugin leia um token do tema com fallback local obrigatorio.

## Arquivo alterado

```text
styles.css
```

## Alteracao aplicada

Antes:

```css
--catalogo-token-accent: var(--catalogo-eaduems-lime);
```

Depois:

```css
--catalogo-token-accent: var(--eaduems-color-accent, var(--catalogo-eaduems-lime));
```

## Guardrail principal

Apenas a declaracao do alias foi alterada. Nenhum seletor consumidor foi reescrito nesta frente.

## Motivo da escolha

`--catalogo-token-accent` foi escolhido porque:

1. `--eaduems-color-accent` existe no tema;
2. `--eaduems-color-accent` resolve para `#d6df2a` nos modos light/dark;
3. `--catalogo-eaduems-lime` tambem e `#d6df2a`;
4. o fallback local preserva o catalogo caso o token do tema nao esteja disponivel.

## Validacao tecnica

Rota validada:

```text
/local/catalogo_eaduems/public/index.php
```

Cenarios validados com Playwright:

| Modo | Viewport | HTTP | Cards | Resultado |
| --- | --- | --- | --- | --- |
| light | desktop | 200 | 8 | OK |
| light | mobile | 200 | 8 | OK |
| dark | desktop | 200 | 8 | OK |
| dark | mobile | 200 | 8 | OK |

## Valores computados

| Token/valor | Resultado observado |
| --- | --- |
| `--eaduems-color-accent` | `#d6df2a` |
| `--catalogo-eaduems-lime` | `#d6df2a` |
| `--catalogo-token-accent` | `#d6df2a` |
| Media/fallback com acento | `rgb(214, 223, 42)` no gradiente |

## Evidencias versionadas no tema

```text
D:\wamp64\www\moodle_teste\public\theme\eaduems\docs\assets\catalog-accent-fallback-pilot-2026-06-30
```

## Resultado

Piloto aprovado tecnicamente.

O primeiro consumo controlado de token do tema foi feito com fallback local e sem mudanca visual esperada.

## Proxima frente recomendada

Antes de ampliar fallback para outros aliases, revisar visualmente as capturas deste piloto. Se aprovadas, o proximo candidato de baixo risco pode ser `--catalogo-token-surface` ou `--catalogo-token-border`, sempre com fallback local.
