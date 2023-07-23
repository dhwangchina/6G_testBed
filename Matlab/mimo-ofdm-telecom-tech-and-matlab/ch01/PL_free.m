function PL = PL_free(fc,dist,Gt,Gr)
% ���ɿռ�·�����ģ��
% ���룺
%     fc  : �ز�Ƶ��[Hz]
%     dist: ��վ���ƶ�̨֮��ľ���[m]
%     Gt  : ������������
%     Gr  : ������������
% �����
%     PL  : ·�����[dB]

lamda = 3e8/fc;
tmp   = lamda./(4*pi*dist);
if nargin > 2,
    tmp = tmp*sqrt(Gt);
end

if nargin > 3,
    tmp = tmp*sqrt(Gr);
end

PL = -20*log10(tmp);


