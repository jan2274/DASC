######################### VPC #########################
# vpc = 10.0.0.0/16
# public-subnet-a = 10.0.0.0/20
# public-subnet-c = 10.0.16.0/20
# private-subnet-a = 10.0.32.0/20
# private-subnet-c = 10.0.48.0/20

resource "aws_vpc" "dasc-vpc-main" {
  cidr_block           = var.vpc_cidr
  enable_dns_hostnames = true
  enable_dns_support   = true

  tags = {
    Name = "Test"
  }
}

################ Subnets #################
resource "aws_subnet" "dasc-subnet-public" {
  count             = length(var.public_subnet_cidrs)
  vpc_id            = aws_vpc.dasc-vpc-main.id
  cidr_block        = var.public_subnet_cidrs[count.index]
  availability_zone = var.availability_zones[count.index]

  tags = {
    Name = "Public-${count.index + 1}"
  }
}

resource "aws_subnet" "dasc-subnet-private" {
  count             = length(var.private_subnet_cidrs)
  vpc_id            = aws_vpc.dasc-vpc-main.id
  cidr_block        = var.private_subnet_cidrs[count.index]
  availability_zone = var.availability_zones[count.index % 2]

  tags = {
    Name = "Private-${count.index + 1}"
  }
}

############# Internet Gateway ############
resource "aws_internet_gateway" "aws-igw-main" {
  vpc_id = aws_vpc.dasc-vpc-main.id

  tags = {
    Name = "dasc-igw-main"
  }
}

############# Route Tables ############
resource "aws_route_table" "dasc-rt-public" {
  vpc_id = aws_vpc.dasc-vpc-main.id

  route {
    cidr_block = "0.0.0.0/0"
    gateway_id = aws_internet_gateway.dasc-igw-main.id
  }

  tags = {
    Name = "Public Route Table"
  }
}

resource "aws_route_table" "dasc-rt-private" {
  vpc_id = aws_vpc.dasc-vpc-main.id

  tags = {
    Name = "Private Route Table"
  }
}

resource "aws_route_table_association" "public" {
  count          = length(aws_subnet.dasc-subnet-public)
  subnet_id      = aws_subnet.dasc-subnet-public[count.index].id
  route_table_id = aws_route_table.dasc-rt-public
}

resource "aws_route_table_association" "private" {
  count          = length(aws_subnet.dasc-subnet-private)
  subnet_id      = aws_subnet.dasc-subnet-public[count.index].id
  route_table_id = aws_route_table.dasc-rt-private.id
}



