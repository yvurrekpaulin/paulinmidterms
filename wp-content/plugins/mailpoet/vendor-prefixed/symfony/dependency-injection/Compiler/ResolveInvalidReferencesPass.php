<?php
 namespace MailPoetVendor\Symfony\Component\DependencyInjection\Compiler; if (!defined('ABSPATH')) exit; use MailPoetVendor\Symfony\Component\DependencyInjection\Argument\ArgumentInterface; use MailPoetVendor\Symfony\Component\DependencyInjection\Argument\ServiceClosureArgument; use MailPoetVendor\Symfony\Component\DependencyInjection\ContainerBuilder; use MailPoetVendor\Symfony\Component\DependencyInjection\ContainerInterface; use MailPoetVendor\Symfony\Component\DependencyInjection\Definition; use MailPoetVendor\Symfony\Component\DependencyInjection\Exception\RuntimeException; use MailPoetVendor\Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException; use MailPoetVendor\Symfony\Component\DependencyInjection\Reference; use MailPoetVendor\Symfony\Component\DependencyInjection\TypedReference; class ResolveInvalidReferencesPass implements \MailPoetVendor\Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface { private $container; private $signalingException; private $currentId; public function process(\MailPoetVendor\Symfony\Component\DependencyInjection\ContainerBuilder $container) { $this->container = $container; $this->signalingException = new \MailPoetVendor\Symfony\Component\DependencyInjection\Exception\RuntimeException('Invalid reference.'); try { foreach ($container->getDefinitions() as $this->currentId => $definition) { $this->processValue($definition); } } finally { $this->container = $this->signalingException = null; } } private function processValue($value, int $rootLevel = 0, int $level = 0) { if ($value instanceof \MailPoetVendor\Symfony\Component\DependencyInjection\Argument\ServiceClosureArgument) { $value->setValues($this->processValue($value->getValues(), 1, 1)); } elseif ($value instanceof \MailPoetVendor\Symfony\Component\DependencyInjection\Argument\ArgumentInterface) { $value->setValues($this->processValue($value->getValues(), $rootLevel, 1 + $level)); } elseif ($value instanceof \MailPoetVendor\Symfony\Component\DependencyInjection\Definition) { if ($value->isSynthetic() || $value->isAbstract()) { return $value; } $value->setArguments($this->processValue($value->getArguments(), 0)); $value->setProperties($this->processValue($value->getProperties(), 1)); $value->setMethodCalls($this->processValue($value->getMethodCalls(), 2)); } elseif (\is_array($value)) { $i = 0; foreach ($value as $k => $v) { try { if (\false !== $i && $k !== $i++) { $i = \false; } if ($v !== ($processedValue = $this->processValue($v, $rootLevel, 1 + $level))) { $value[$k] = $processedValue; } } catch (\MailPoetVendor\Symfony\Component\DependencyInjection\Exception\RuntimeException $e) { if ($rootLevel < $level || $rootLevel && !$level) { unset($value[$k]); } elseif ($rootLevel) { throw $e; } else { $value[$k] = null; } } } if (\false !== $i) { $value = \array_values($value); } } elseif ($value instanceof \MailPoetVendor\Symfony\Component\DependencyInjection\Reference) { if ($this->container->has($id = (string) $value)) { return $value; } $currentDefinition = $this->container->getDefinition($this->currentId); if ($currentDefinition->innerServiceId === $id && \MailPoetVendor\Symfony\Component\DependencyInjection\ContainerInterface::NULL_ON_INVALID_REFERENCE === $currentDefinition->decorationOnInvalid) { return null; } $invalidBehavior = $value->getInvalidBehavior(); if (\MailPoetVendor\Symfony\Component\DependencyInjection\ContainerInterface::RUNTIME_EXCEPTION_ON_INVALID_REFERENCE === $invalidBehavior && $value instanceof \MailPoetVendor\Symfony\Component\DependencyInjection\TypedReference && !$this->container->has($id)) { $e = new \MailPoetVendor\Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException($id, $this->currentId); $this->container->register($id = \sprintf('.errored.%s.%s', $this->currentId, $id), $value->getType())->addError($e->getMessage()); return new \MailPoetVendor\Symfony\Component\DependencyInjection\TypedReference($id, $value->getType(), $value->getInvalidBehavior()); } if (\MailPoetVendor\Symfony\Component\DependencyInjection\ContainerInterface::NULL_ON_INVALID_REFERENCE === $invalidBehavior) { $value = null; } elseif (\MailPoetVendor\Symfony\Component\DependencyInjection\ContainerInterface::IGNORE_ON_INVALID_REFERENCE === $invalidBehavior) { if (0 < $level || $rootLevel) { throw $this->signalingException; } $value = null; } } return $value; } } 