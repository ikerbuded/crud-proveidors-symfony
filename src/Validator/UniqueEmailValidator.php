<?php

namespace App\Validator;

use App\Entity\Proveidor;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class UniqueEmailValidator extends ConstraintValidator
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof UniqueEmail) {
            throw new UnexpectedTypeException($constraint, UniqueEmail::class);
        }

        if (!$value instanceof Proveidor) {
            return;
        }

        $existingProveidor = $this->entityManager->getRepository(Proveidor::class)
            ->findOneBy(['email' => $value->getEmail()]);

        if ($existingProveidor && $existingProveidor->getId() !== $value->getId()) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ value }}', $value->getEmail())
                ->addViolation();
        }
    }
}
