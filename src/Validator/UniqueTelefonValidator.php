<?php

namespace App\Validator;

use App\Entity\Proveidor;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class UniqueTelefonValidator extends ConstraintValidator
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof UniqueTelefon) {
            throw new UnexpectedTypeException($constraint, UniqueTelefon::class);
        }

        if (!$value instanceof Proveidor) {
            return;
        }

        $existingProveidor = $this->entityManager->getRepository(Proveidor::class)
            ->findOneBy(['telefon' => $value->getTelefon()]);

        if ($existingProveidor && $existingProveidor->getId() !== $value->getId()) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ value }}', $value->getTelefon())
                ->addViolation();
        }
    }
}
