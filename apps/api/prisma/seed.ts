import { PrismaClient, Role, SupportType, SupportStatus } from '@prisma/client';

const prisma = new PrismaClient();

async function main() {
  console.log('🌱 Début du peuplement (seeding) de la base de données ISP-Bukavu...');

  // 1. Année Académique
  const academicYear = await prisma.academicYear.upsert({
    where: { code: '2023-2024' },
    update: {},
    create: {
      code: '2023-2024',
      label: 'Année Académique 2023-2024',
      startDate: new Date('2023-10-15'),
      endDate: new Date('2024-07-31'),
      isActive: true,
    },
  });
  console.log(`✓ Année académique: ${academicYear.label}`);

  // 2. Structure Académique : Section -> Département -> Programme -> Promotions
  const sectionSCAI = await prisma.section.upsert({
    where: { name: 'Sciences Commerciales, Administratives et Informatique (SCAI)' },
    update: {},
    create: {
      name: 'Sciences Commerciales, Administratives et Informatique (SCAI)',
      description: 'Section dédiée aux sciences informatiques, gestion et sciences commerciales',
    },
  });

  const sectionExactes = await prisma.section.upsert({
    where: { name: 'Sciences Exactes' },
    update: {},
    create: {
      name: 'Sciences Exactes',
      description: 'Section dédiée aux mathématiques, physique et sciences appliquées',
    },
  });

  // Département Informatique
  let deptInfo = await prisma.department.findFirst({
    where: { name: 'Informatique de Gestion', sectionId: sectionSCAI.id },
  });
  if (!deptInfo) {
    deptInfo = await prisma.department.create({
      data: {
        name: 'Informatique de Gestion',
        sectionId: sectionSCAI.id,
      },
    });
  }

  // Programme
  let progLMD = await prisma.program.findFirst({
    where: { name: 'Licence en Informatique de Gestion (LMD)', departmentId: deptInfo.id },
  });
  if (!progLMD) {
    progLMD = await prisma.program.create({
      data: {
        name: 'Licence en Informatique de Gestion (LMD)',
        departmentId: deptInfo.id,
      },
    });
  }

  // Promotions
  const promBac1 = await prisma.promotion.upsert({
    where: { id: 'prom-bac1-ig' },
    update: {},
    create: {
      id: 'prom-bac1-ig',
      name: 'BAC1 Informatique de Gestion (L1 LMD)',
      programId: progLMD.id,
    },
  });

  const promBac2 = await prisma.promotion.upsert({
    where: { id: 'prom-bac2-ig' },
    update: {},
    create: {
      id: 'prom-bac2-ig',
      name: 'BAC2 Informatique de Gestion (L2 LMD)',
      programId: progLMD.id,
    },
  });

  const promBac3 = await prisma.promotion.upsert({
    where: { id: 'prom-bac3-ig' },
    update: {},
    create: {
      id: 'prom-bac3-ig',
      name: 'BAC3 Informatique de Gestion (L3 LMD)',
      programId: progLMD.id,
    },
  });
  console.log(`✓ Structure académique créée (SCAI > Informatique de Gestion > BAC1, BAC2, BAC3)`);

  // 3. Catégories de supports
  const catProg = await prisma.category.upsert({
    where: { name: 'Programmation & Développement' },
    update: {},
    create: { name: 'Programmation & Développement' },
  });

  const catBdd = await prisma.category.upsert({
    where: { name: 'Bases de Données & Modélisation' },
    update: {},
    create: { name: 'Bases de Données & Modélisation' },
  });

  const catPedago = await prisma.category.upsert({
    where: { name: 'Pédagogie & Méthodologie' },
    update: {},
    create: { name: 'Pédagogie & Méthodologie' },
  });

  // 4. Utilisateurs de test
  // Mot de passe standard : $argon2id$ (ou hash représentatif)
  const defaultPasswordHash = '$argon2id$v=19$m=65536,t=3,p=4$dGVzdHNhbHQ$hashed_secret_password_for_testing';

  // 4.1 Super Administrateur
  const adminUser = await prisma.user.upsert({
    where: { email: 'admin@isp-bukavu.ac.cd' },
    update: {},
    create: {
      email: 'admin@isp-bukavu.ac.cd',
      passwordHash: defaultPasswordHash,
      firstName: 'Prince',
      lastName: 'Abibu',
      phoneNumber: '+243990000001',
      role: Role.SUPER_ADMIN,
      isActive: true,
    },
  });

  // 4.2 Administrateur Académique
  const academicAdmin = await prisma.user.upsert({
    where: { email: 'academic@isp-bukavu.ac.cd' },
    update: {},
    create: {
      email: 'academic@isp-bukavu.ac.cd',
      passwordHash: defaultPasswordHash,
      firstName: 'Jean-Pierre',
      lastName: 'Mukamba',
      phoneNumber: '+243990000002',
      role: Role.ACADEMIC_ADMIN,
      isActive: true,
    },
  });

  // 4.3 Enseignants
  const profKendaUser = await prisma.user.upsert({
    where: { email: 'kenda@isp-bukavu.ac.cd' },
    update: {},
    create: {
      email: 'kenda@isp-bukavu.ac.cd',
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

  // 4.4 Étudiants de test
  const studentBac1User = await prisma.user.upsert({
    where: { email: 'etudiant.bac1@isp-bukavu.ac.cd' },
    update: {},
    create: {
      email: 'etudiant.bac1@isp-bukavu.ac.cd',
      passwordHash: defaultPasswordHash,
      firstName: 'Yoshua',
      lastName: 'Ayamba',
      phoneNumber: '+243990000020',
      role: Role.STUDENT,
      isActive: true,
      studentProfile: {
        create: {
          matricule: 'ISP-2024-0012',
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
        matricule: 'ISP-2024-0012',
        gender: 'M',
        promotionId: promBac1.id,
      },
    });
  }

  const studentBac2User = await prisma.user.upsert({
    where: { email: 'etudiant.bac2@isp-bukavu.ac.cd' },
    update: {},
    create: {
      email: 'etudiant.bac2@isp-bukavu.ac.cd',
      passwordHash: defaultPasswordHash,
      firstName: 'Sarah',
      lastName: 'Nabintu',
      phoneNumber: '+243990000021',
      role: Role.STUDENT,
      isActive: true,
      studentProfile: {
        create: {
          matricule: 'ISP-2024-0045',
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
        matricule: 'ISP-2024-0045',
        gender: 'F',
        promotionId: promBac2.id,
      },
    });
  }
  console.log(`✓ Utilisateurs créés (Admin, Académique, Enseignant Kenda, Étudiants BAC1 & BAC2)`);

  // 5. Cours
  let courseWeb = await prisma.course.findFirst({ where: { name: 'Développement Web & Architecture Client-Serveur' } });
  if (!courseWeb) {
    courseWeb = await prisma.course.create({
      data: {
        name: 'Développement Web & Architecture Client-Serveur',
        description: 'Technologies Web modernes: HTML5, CSS3, TypeScript, React et NestJS',
      },
    });
  }

  let courseBdd = await prisma.course.findFirst({ where: { name: 'Conception et Administration des Bases de Données' } });
  if (!courseBdd) {
    courseBdd = await prisma.course.create({
      data: {
        name: 'Conception et Administration des Bases de Données',
        description: 'Modélisation relationnelle, SQL avancé, ORM Prisma et PostgreSQL',
      },
    });
  }

  // 6. Affectation Enseignant (TeacherCourseAssignment)
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
      type: 'Cours Magistral + TP',
      status: 'ACTIVE',
    },
  });
  console.log(`✓ Affectation de cours créée pour Prof. Kenda sur BAC1`);

  // 7. Supports Pédagogiques de test
  let support1 = await prisma.support.findFirst({ where: { title: 'Syllabus complet - Développement Web Moderne' } });
  if (!support1) {
    support1 = await prisma.support.create({
      data: {
        title: 'Syllabus complet - Développement Web Moderne',
        description: 'Support de cours magistral comprenant l’ensemble des chapitres du semestre 1.',
        keywords: 'web, javascript, typescript, react, nestjs, api',
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

  let support2 = await prisma.support.findFirst({ where: { title: 'Travaux Pratiques N°1 - Modélisation & SQL' } });
  if (!support2) {
    support2 = await prisma.support.create({
      data: {
        title: 'Travaux Pratiques N°1 - Modélisation & SQL',
        description: 'Énoncé du TP 1 avec cas pratiques sur la modélisation sous PostgreSQL.',
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

  console.log('✓ Supports pédagogiques créés avec liaison aux promotions');
  console.log('🎉 Seeding terminé avec succès !');
}

main()
  .catch((e) => {
    console.error('Erreur lors du seeding :', e);
    process.exit(1);
  })
  .finally(async () => {
    await prisma.$disconnect();
  });
