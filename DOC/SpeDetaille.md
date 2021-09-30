
## Database

- Users
  - ID
  - Name
  - Surname
  - isRDZ
  - Credits 4000m
  - Credits 1500m
  - Phone number
  - Mail address

- Planes
  - ID
  - Model
  - registration
  - Seat count

- Flights
  - ID
  - Planes::ID
  - Departure
  
- FlightUser
  - Flights::ID
  - Users::ID

## Important

- Logs des achats

- Inscription dans la base de donnée des avions décollés, avec les participants au vol

- Quand un RDZ en "day off" se connecte, il risque de se connecter en tant qu'admin. Il faut donc quand un RDZ se connecte, une vérification "connect as admin ? Yes/No"

## Point chaud

- Concurence avec les crédits (si 2 users prennent la dernière place en même temps)
