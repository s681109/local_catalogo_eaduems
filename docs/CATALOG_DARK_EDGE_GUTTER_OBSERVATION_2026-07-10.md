# Catalog Dark Edge Gutter Observation v1

Data: 2026-07-10
Status: observacao encerrada; tratada e validada por CDS-01
Repositorio: `local_catalogo_eaduems`

## Sintoma

Em algumas capturas do catálogo público (`/local/catalogo_eaduems/public/index.php`), com maior evidência em dark mode e viewport estreita, o conteúdo claro do catálogo não aparenta ocupar visualmente toda a largura do shell. O fundo dark do Moodle torna visíveis faixas laterais/espaços de borda ao redor da área principal.

A observação foi reportada durante a revisão visual da rodada de regressão de 2026-07-10.

## Evidências Relacionadas

Capturas de regressão do tema:

```text
D:\wamp64\www\moodle_teste\public\theme\eaduems\docs\assets\dark-mode-global-regression-v1-regression-2026-07-10
```

Rota:

```text
/local/catalogo_eaduems/public/index.php
```

## Diagnóstico Preliminar

O plugin contém regras de layout full-bleed e responsivas que usam, entre outros padrões:

```css
width: 100vw;
max-width: 100vw;
margin-left: -50vw;
```

Além disso, há múltiplas media queries específicas para a rota pública do catálogo. Esses padrões são legítimos no contexto de um plugin independente, mas podem expor a diferença entre a surface clara do catálogo e o fundo dark do shell Moodle em determinadas larguras, zooms ou composições de drawer.

Esta é uma hipótese técnica, não uma causa confirmada.

## Decisão

Não aplicar correção visual pontual agora.

Motivos:

1. o problema envolve o limite entre shell Moodle, tema e plugin;
2. uma correção por seletor amplo poderia mascarar overflow ou prejudicar a independência do plugin em outro tema;
3. a frente `Catalog Theme Independence Compatibility v1` exige fallback local e comportamento estável sem o tema EADUEMS;
4. a observação precisa de baseline isolada com métricas de borda antes de mudar `width`, margens ou superfícies.

## Próxima Ação Recomendada

Abrir `Catalog Dark Edge Gutter Diagnostic v1` quando a frente de catálogo for retomada, com:

1. capturas em 320px, 390px, 768px e 1366px;
2. light/dark e usuário visitante/autenticado quando relevante;
3. medição de `documentElement.scrollWidth`, `page-wrapper`, `#page`, `#region-main` e raiz do catálogo;
4. comparação com um tema Moodle não-EADUEMS, preservando a independência do plugin;
5. somente depois, um piloto local de surface/full-bleed se a causa for confirmada.
## Atualizacao - Diagnostico Executado

O diagnostico tecnico foi executado em docs/CATALOG_DARK_EDGE_GUTTER_DIAGNOSTIC_V1_2026-07-10.md.

Resultado: nao ha overflow nem perda de largura da raiz do catalogo. As faixas observadas decorrem da composicao entre shell dark, raiz transparente e area interna de resultados limitada.

## Encerramento

O diagnostico confirmou que o sintoma nao era overflow horizontal, mas descontinuidade entre a surface transparente do plugin e o shell dark. O `CDS-01` aplicou uma surface local continua sem alterar larguras, margens ou regras globais do Moodle.

Resultado aprovado tecnica e visualmente em 2026-07-10. O dark mode semantico completo do catalogo permanece como frente posterior ao `CTI-02 real`.