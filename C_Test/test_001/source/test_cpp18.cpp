/*
 * C++ Programing Language
 * test_cpp18.cpp
 */
#include <iostream>
#include <array>
#include "test_cpp18.hpp"
#include <assert.h>

using namespace std;
double read_and_sum(int s)
{
	Vector v(s);
	std::cout<<"Please input "<<s<<" number.\n";
	for(int i = 0; i < v.size(); i++)
	{
		std::cin>>v[i];
	}

	static_assert(3 > 2,"HOHOHO");

	for(int i = 0; i < v.size(); i++)
	{
		std::cout<<v[i];
	}
	std::cout<<endl;

	double sum = 0;
	for(int i = 0; i < v.size(); i++)
	{
		sum += v[i];
	}
	return sum;
}

ostream& operator<<(ostream& os, Point p)
{
	cout<<'{'<<p.x<<p.y<<'}';
}

void print(Point a[], int sz)
{
	for(int i=0; i != sz; ++i)
	{
		cout<<a[i]<<'\n';
	}
}

template <typename T, int N>
void print(array<T,N>& a)
{
	for(int i = 0; i != a.size(); ++i)
	{
		cout<<a[i]<<'\n';
	}
}

void f_Point()
{
	Point point1[] = {{1,2},{3,4},{5,6}};
	array<Point,3> point2 = {{7,8},{9,10},{11,12}};

	print(point1,3);
	print(point2);
}

