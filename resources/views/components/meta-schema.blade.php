<script type="application/ld+json">
<?php
  /** @var string $type */
  /** @var string $name */
  /** @var string $description */
  /** @var array $schema */

  $data = array_merge([
    '@context' => 'https://schema.org/',
    '@type' => $type,
    'name' => $name,
    'description' => $description,
  ], $schema);
?>
@json($data)
</script>
