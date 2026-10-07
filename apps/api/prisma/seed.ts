import { PrismaClient, Role, SupportType, SupportStatus } from '@prisma/client';

const prisma = new PrismaClient();

async function main() {
  console.log('🌱 Début du peuplement (seeding) de la base de données Université Catholique de Bukavu (UCB)...');

  // 1. Année Académique
  const academicYear = await prisma.academicYear.upsert({
    where: { code: '2023-2024' },
    update: {},
    create: {
      code: '2023-2024',
      label: 'Année Académique 2023-2024 (UCB)',
      startDate: new Date('2023-10-15'),
      endDate: new Date('2024-07-31'),
      isActive: true,
    },
  });
  console.log(`✓ Année académique: ${academicYear.label}`);

  // 2. Facultés de l'Université Catholique de Bukavu (UCB)
  const facSciences = await prisma.section.upsert({
    where: { name: 'Faculté des Sciences et Technologies (FST)' },
    update: {},
    create: {
      name: 'Faculté des Sciences et Technologies (FST)',
      description: 'Sciences Informatiques, Sciences de l’Environnement et Département Polytechnique (Génie)',
    },
  });

  const facEco = await prisma.section.upsert({
    where: { name: 'Faculté des Sciences Économiques et de Gestion (FASEG)' },
    update: {},
    create: {
      name: 'Faculté des Sciences Économiques et de Gestion (FASEG)',
      description: 'Économie de Gestion, Finance & Comptabilité, Économie de Développement',
    },
  });

  const facDroit = await prisma.section.upsert({
    where: { name: 'Faculté de Droit' },
    update: {},
    create: {
      name: 'Faculté de Droit',
      description: 'Droit Économique et des Affaires, Droit Privé et Judiciaire, Droit Public',
    },
  });

  const facMedecine = await prisma.section.upsert({
    where: { name: 'Faculté de Médecine' },
    update: {},
    create: {
      name: 'Faculté de Médecine',
      description: 'Médecine Générale, Chirurgie, Spécialisations Médicales et Santé Publique',
    },
  });

  const facAgro = await prisma.section.upsert({
    where: { name: 'Faculté des Sciences Agronomiques et Environnementales (FSA)' },
    update: {},
    create: {
      name: 'Faculté des Sciences Agronomiques et Environnementales (FSA)',
      description: 'Phytotechnie, Écosystèmes et Agroéconomie',
    },
  });

  const ecoleArchi = await prisma.section.upsert({
    where: { name: 'École d’Architecture et d’Urbanisme (EAU)' },
    update: {},
    create: {
      name: 'École d’Architecture et d’Urbanisme (EAU)',
      description: 'Formation d’architectes et urbanistes professionnels',
    },
  });

  console.log('✓ Facultés et Écoles UCB créées (FST, FASEG, Droit, Médecine, FSA, Architecture)');

  // 3. Départements au sein de la Faculté des Sciences et Technologies
  let deptInfo = await prisma.department.findFirst({
    where: { name: 'Sciences Informatiques', sectionId: facSciences.id },
  });
  if (!deptInfo) {
    deptInfo = await prisma.department.create({
      data: {
        name: 'Sciences Informatiques',
        sectionId: facSciences.id,
      },
    });
  }

  let deptPolytech = await prisma.department.findFirst({
    where: { name: 'Polytechnique (Génie Chimique et Métallurgie)', sectionId: facSciences.id },
  });
  if (!deptPolytech) {
    deptPolytech = await prisma.department.create({
      data: {
        name: 'Polytechnique (Génie Chimique et Métallurgie)',
        sectionId: facSciences.id,
      },
    });
  }

  // 4. Programme d'études (Filière)
  let progInfo = await prisma.program.findFirst({
    where: { name: 'Licence en Sciences Informatiques (LMD - Génie Logiciel)', departmentId: deptInfo.id },
  });
  if (!progInfo) {
    progInfo = await prisma.program.create({
      data: {
        name: 'Licence en Sciences Informatiques (LMD - Génie Logiciel)',
        departmentId: deptInfo.id,
      },
    });
  }

  // 5. Promotions
  const promBac1 = await prisma.promotion.upsert({
    where: { id: 'prom-bac1-info' },
    update: {},
    create: {
      id: 'prom-bac1-info',
      name: 'BAC1 Sciences Informatiques (L1 LMD)',
      programId: progInfo.id,
    },
  });

  const promBac2 = await prisma.promotion.upsert({
    where: { id: 'prom-bac2-info' },
    update: {},
    create: {
      id: 'prom-bac2-info',
      name: 'BAC2 Sciences Informatiques (L2 LMD)',
      programId: progInfo.id,
    },
  });

  const promBac3 = await prisma.promotion.upsert({
    where: { id: 'prom-bac3-info' },
    update: {},
    create: {
      id: 'prom-bac3-info',
      name: 'BAC3 Sciences Informatiques (L3 LMD)',
      programId: progInfo.id,
    },
  });
  console.log(`✓ Filière Sciences Informatiques configurée avec les promotions BAC1, BAC2, BAC3`);

  // 6. Catégories de supports
  const catProg = await prisma.category.upsert({
    where: { name: 'Génie Logiciel & Programmation' },
    update: {},
    create: { name: 'Génie Logiciel & Programmation' },
  });

  const catBdd = await prisma.category.upsert({
    where: { name: 'Bases de Données & Systèmes d’Information' },
    update: {},
    create: { name: 'Bases de Données & Systèmes d’Information' },
  });

  const catReseaux = await prisma.category.upsert({
    where: { name: 'Réseaux & Télécommunications' },
    update: {},
    create: { name: 'Réseaux & Télécommunications' },
  });

  // 7. Utilisateurs de test (Université Catholique de Bukavu)
  const defaultPasswordHash = '$argon2id$v=19$m=65536,t=3,p=4$dGVzdHNhbHQ$hashed_secret_password_for_testing';

  // 7.1 Super Administrateur
  const adminUser = await prisma.user.upsert({
    where: { email: 'admin@ucbukavu.ac.cd' },
    update: {},
    create: {
      email: 'admin@ucbukavu.ac.cd',
      passwordHash: defaultPasswordHash,
      firstName: 'Prince',
      lastName: 'Abibu',
      phoneNumber: '+243990000001',
      role: Role.SUPER_ADMIN,
      isActive: true,
    },
  });

  // 7.2 Administrateur Académique (Secrétaire Général Académique UCB)
  const academicAdmin = await prisma.user.upsert({
    where: { email: 'academic@ucbukavu.ac.cd' },
    update: {},
    create: {
      email: 'academic@ucbukavu.ac.cd',
      passwordHash: defaultPasswordHash,
      firstName: 'Jean-Pierre',
      lastName: 'Mukamba',
      phoneNumber: '+243990000002',
      role: Role.ACADEMIC_ADMIN,
      isActive: true,
    },
  });

  // 7.3 Enseignant UCB
  const profKendaUser = await prisma.user.upsert({
    where: { email: 'prof.kenda@ucbukavu.ac.cd' },
    update: {},
    create: {
      email: 'prof.kenda@ucbukavu.ac.cd',
      passwordHash: defaultPasswordHash,
      firstName: 'Kenda',
      lastName: 'Kasongo',
      phoneNumber: '+243990000010',
      role: Role.TEACHER,
      isActive: true,
      teacherProfile: {
        create: {
          academicTitle: 'Professeur Ordinaire',
          departmentId: deptInfo.id,
        },
      },
    },
  });

  let teacherKenda = await prisma.teacher.findUnique({ where: { userId: profKendaUser.id } });
  if (!teacherKenda) {
    teacherKenda = await prisma.teacher.create({
      data: {
        userId: profKendaUser.id,
        academicTitle: 'Professeur Ordinaire',
        departmentId: deptInfo.id,
      },
    });
  }

  // 7.4 Étudiants UCB
  const studentBac1User = await prisma.user.upsert({
    where: { email: 'etudiant.bac1@ucbukavu.ac.cd' },
    update: {},
    create: {
      email: 'etudiant.bac1@ucbukavu.ac.cd',
      passwordHash: defaultPasswordHash,
      firstName: 'Yoshua',
      lastName: 'Ayamba',
      phoneNumber: '+243990000020',
      role: Role.STUDENT,
      isActive: true,
      studentProfile: {
        create: {
          matricule: 'UCB-2024-0012',
          gender: 'M',
          promotionId: promBac1.id,
        },
      },
    },
  });

  let studentBac1 = await prisma.student.findUnique({ where: { userId: studentBac1User.id } });
  if (!studentBac1) {
    studentBac1 = await prisma.student.create({
      data: {
        userId: studentBac1User.id,
        matricule: 'UCB-2024-0012',
        gender: 'M',
        promotionId: promBac1.id,
      },
    });
  }

  const studentBac2User = await prisma.user.upsert({
    where: { email: 'etudiant.bac2@ucbukavu.ac.cd' },
    update: {},
    create: {
      email: 'etudiant.bac2@ucbukavu.ac.cd',
      passwordHash: defaultPasswordHash,
      firstName: 'Sarah',
      lastName: 'Nabintu',
      phoneNumber: '+243990000021',
      role: Role.STUDENT,
      isActive: true,
      studentProfile: {
        create: {
          matricule: 'UCB-2024-0045',
          gender: 'F',
          promotionId: promBac2.id,
        },
      },
    },
  });

  let studentBac2 = await prisma.student.findUnique({ where: { userId: studentBac2User.id } });
  if (!studentBac2) {
    studentBac2 = await prisma.student.create({
      data: {
        userId: studentBac2User.id,
        matricule: 'UCB-2024-0045',
        gender: 'F',
        promotionId: promBac2.id,
      },
    });
  }
  console.log(`✓ Utilisateurs UCB créés (Admin, Académique, Prof. Kenda, Étudiants BAC1 & BAC2)`);

  // 8. Cours
  let courseWeb = await prisma.course.findFirst({ where: { name: 'Développement Web Moderne & Systèmes Distribués' } });
  if (!courseWeb) {
    courseWeb = await prisma.course.create({
      data: {
        name: 'Développement Web Moderne & Systèmes Distribués',
        description: 'Technologies Web: Architecture TypeScript, React, NestJS et APIs RESTful',
      },
    });
  }

  let courseBdd = await prisma.course.findFirst({ where: { name: 'Conception et Administration des Bases de Données Relationnelles' } });
  if (!courseBdd) {
    courseBdd = await prisma.course.create({
      data: {
        name: 'Conception et Administration des Bases de Données Relationnelles',
        description: 'Modélisation relationnelle, SQL avancé, ORM Prisma et PostgreSQL',
      },
    });
  }

  // 9. Affectation Enseignant (TeacherCourseAssignment)
  const assignment = await prisma.teacherCourseAssignment.upsert({
    where: {
      teacherId_courseId_promotionId_academicYearId: {
        teacherId: teacherKenda.id,
        courseId: courseWeb.id,
        promotionId: promBac1.id,
        academicYearId: academicYear.id,
      },
    },
    update: {},
    create: {
      teacherId: teacherKenda.id,
      courseId: courseWeb.id,
      promotionId: promBac1.id,
      academicYearId: academicYear.id,
      semester: 'Semestre 1',
      hourlyVolume: 45,
      type: 'Cours Magistral + Travaux Pratiques',
      status: 'ACTIVE',
    },
  });
  console.log(`✓ Affectation de cours créée pour Prof. Kenda sur BAC1 Informatique`);

  // 10. Supports Pédagogiques UCB
  let support1 = await prisma.support.findFirst({ where: { title: 'Syllabus complet - Développement Web Moderne (UCB-FST)' } });
  if (!support1) {
    support1 = await prisma.support.create({
      data: {
        title: 'Syllabus complet - Développement Web Moderne (UCB-FST)',
        description: 'Support de cours magistral comprenant l’ensemble des chapitres du semestre 1.',
        keywords: 'ucb, web, javascript, typescript, react, nestjs, api',
        type: SupportType.SYLLABUS,
        status: SupportStatus.PUBLISHED,
        version: 1,
        publishedAt: new Date(),
        courseId: courseWeb.id,
        categoryId: catProg.id,
        teacherId: teacherKenda.id,
        academicYearId: academicYear.id,
        promotions: {
          create: [{ promotionId: promBac1.id }],
        },
      },
    });
  }

  let support2 = await prisma.support.findFirst({ where: { title: 'Travaux Pratiques N°1 - Modélisation & SQL PostgreSQL' } });
  if (!support2) {
    support2 = await prisma.support.create({
      data: {
        title: 'Travaux Pratiques N°1 - Modélisation & SQL PostgreSQL',
        description: 'Énoncé du TP 1 avec cas pratiques sur la modélisation sous PostgreSQL à l’UCB.',
        keywords: 'tp, sql, postgresql, relations, requetes',
        type: SupportType.TP,
        status: SupportStatus.PUBLISHED,
        version: 1,
        publishedAt: new Date(),
        courseId: courseBdd.id,
        categoryId: catBdd.id,
        teacherId: teacherKenda.id,
        academicYearId: academicYear.id,
        promotions: {
          create: [{ promotionId: promBac1.id }, { promotionId: promBac2.id }],
        },
      },
    });
  }

  console.log('✓ Supports pédagogiques UCB créés avec liaison aux promotions');
  console.log('🎉 Seeding UCB Bukavu terminé avec succès !');
}

main()
  .catch((e) => {
    console.error('Erreur lors du seeding :', e);
    process.exit(1);
  })
  .finally(async () => {
    await prisma.$disconnect();
  });
